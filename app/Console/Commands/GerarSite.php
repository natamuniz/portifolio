<?php

namespace App\Console\Commands;

use App\Portfolio\RepositorioProjetos;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use RuntimeException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Gera o site estático em dist/: passa cada página pelo próprio Laravel e salva o HTML.
 * É o que vai para a Cloudflare Pages, que só serve arquivos prontos.
 */
#[Signature('site:gerar {--destino=dist : Pasta onde o site é salvo}')]
#[Description('Gera o site estático (HTML, imagens e arquivos de public/) para publicar')]
class GerarSite extends Command
{
    /** Arquivos de public/ que só fazem sentido com PHP rodando. */
    private const IGNORAR = ['index.php', '.htaccess'];

    public function handle(Kernel $kernel, Filesystem $arquivos, RepositorioProjetos $projetos): int
    {
        $destino = base_path($this->option('destino'));

        $arquivos->deleteDirectory($destino);
        $arquivos->copyDirectory(public_path(), $destino);
        foreach (self::IGNORAR as $nome) {
            $arquivos->delete("{$destino}/{$nome}");
        }

        $fila = collect(['/', '/sitemap.xml'])
            ->merge($projetos->todos()->map->url())
            ->all();
        $feitos = [];

        while ($caminho = array_shift($fila)) {
            if (isset($feitos[$caminho])) {
                continue;
            }
            $feitos[$caminho] = true;

            $resposta = $this->pedir($kernel, $caminho);

            if ($resposta->getStatusCode() !== 200) {
                throw new RuntimeException("{$caminho} respondeu {$resposta->getStatusCode()}");
            }

            $conteudo = $resposta instanceof BinaryFileResponse
                ? file_get_contents($resposta->getFile()->getPathname())
                : $resposta->getContent();

            $this->salvar($arquivos, $destino, $caminho, $conteudo);

            // Imagens usadas na página entram na fila para serem geradas também.
            if (str_ends_with($caminho, '/')) {
                array_push($fila, ...$this->imagensDaPagina($conteudo));
            }
        }

        // A Cloudflare Pages usa o 404.html na raiz para qualquer endereço que não existe.
        $naoEncontrado = $this->pedir($kernel, '/__pagina-que-nao-existe');
        $arquivos->put("{$destino}/404.html", $naoEncontrado->getContent());

        $this->components->info(count($feitos).' arquivos gerados em '.$this->option('destino').'/');

        return self::SUCCESS;
    }

    private function pedir(Kernel $kernel, string $caminho): Response
    {
        $resposta = $kernel->handle($pedido = Request::create($caminho));
        $kernel->terminate($pedido, $resposta);

        return $resposta;
    }

    private function salvar(Filesystem $arquivos, string $destino, string $caminho, string $conteudo): void
    {
        $arquivo = $destino.(str_ends_with($caminho, '/') ? $caminho.'index.html' : $caminho);

        $arquivos->ensureDirectoryExists(dirname($arquivo));
        $arquivos->put($arquivo, $conteudo);
    }

    /** @return list<string> */
    private function imagensDaPagina(string $html): array
    {
        preg_match_all('#(/img/[\w./-]+\.webp)#', $html, $achados);

        return array_values(array_unique($achados[1]));
    }
}
