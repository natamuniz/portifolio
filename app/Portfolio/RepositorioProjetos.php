<?php

namespace App\Portfolio;

use Illuminate\Support\Collection;
use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;

/**
 * Lê os projetos das pastas em resources/content/projetos.
 * Cada pasta tem um index.md (cabeçalho YAML + texto em Markdown) e as imagens do projeto.
 */
class RepositorioProjetos
{
    /** @var Collection<int, Projeto>|null */
    private ?Collection $cache = null;

    public function __construct(private readonly string $pasta) {}

    /**
     * Todos os projetos: destaques primeiro (pela ordem), depois os outros.
     *
     * @return Collection<int, Projeto>
     */
    public function todos(): Collection
    {
        return $this->cache ??= $this->carregar()
            ->sort(fn (Projeto $a, Projeto $b) => [$b->destaque, $a->ordem, $b->ano] <=> [$a->destaque, $b->ordem, $a->ano])
            ->values();
    }

    /** @return Collection<int, Projeto> */
    public function destaques(): Collection
    {
        return $this->todos()->filter->destaque->values();
    }

    /** @return Collection<int, Projeto> */
    public function outros(): Collection
    {
        return $this->todos()
            ->reject->destaque
            ->sortBy('codigo', SORT_NATURAL)
            ->values();
    }

    public function encontrar(string $slug): ?Projeto
    {
        return $this->todos()->firstWhere('slug', $slug);
    }

    /** Caminho no disco de uma imagem do projeto, procurando pelo nome sem extensão. */
    public function arquivoDeImagem(string $slug, string $nome): ?string
    {
        if (! preg_match('/^[a-z0-9-]+$/', $slug) || ! preg_match('/^[\w-]+$/', $nome)) {
            return null;
        }

        $achados = glob("{$this->pasta}/{$slug}/{$nome}.{png,jpg,jpeg,webp}", GLOB_BRACE) ?: [];

        return $achados[0] ?? null;
    }

    /** @return Collection<int, Projeto> */
    private function carregar(): Collection
    {
        return collect(glob("{$this->pasta}/*/index.md") ?: [])
            ->map(fn (string $arquivo) => $this->lerArquivo($arquivo));
    }

    private function lerArquivo(string $arquivo): Projeto
    {
        $conteudo = file_get_contents($arquivo);

        if (! preg_match('/\A---\R(.*?)\R---\R?(.*)\z/s', $conteudo, $partes)) {
            throw new InvalidArgumentException("{$arquivo}: falta o cabeçalho entre linhas ---");
        }

        $dados = Yaml::parse($partes[1]);
        $slug = basename(dirname($arquivo));
        $capa = $this->nomeDaImagem($dados['capa'] ?? null);
        $galeria = array_map(fn (array $g) => [
            'arquivo' => $this->nomeDaImagem($g['src']),
            'alt' => (string) $g['alt'],
        ], $dados['galeria'] ?? []);

        foreach (['titulo', 'codigo', 'ano', 'tipo', 'resumo'] as $campo) {
            if (blank($dados[$campo] ?? null)) {
                throw new InvalidArgumentException("{$arquivo}: o campo '{$campo}' é obrigatório");
            }
        }

        return new Projeto(
            slug: $slug,
            titulo: (string) $dados['titulo'],
            codigo: (string) $dados['codigo'],
            ano: (int) $dados['ano'],
            tipo: (string) $dados['tipo'],
            resumo: (string) $dados['resumo'],
            papel: $dados['papel'] ?? null,
            stack: array_map('strval', $dados['stack'] ?? []),
            link: $dados['link'] ?? null,
            repositorio: $dados['repositorio'] ?? null,
            selo: $dados['selo'] ?? null,
            capa: $capa,
            capaAlt: $dados['capaAlt'] ?? null,
            previa: isset($dados['previa']) ? rtrim($dados['previa']) : null,
            galeria: $galeria,
            destaque: (bool) ($dados['destaque'] ?? false),
            ordem: (int) ($dados['ordem'] ?? 99),
            corpo: $partes[2],
            dimensoes: $this->medirImagens(dirname($arquivo), [$capa, ...array_column($galeria, 'arquivo')]),
        );
    }

    /**
     * @param  list<string|null>  $nomes
     * @return array<string, array{0: int, 1: int}>
     */
    private function medirImagens(string $pasta, array $nomes): array
    {
        $dimensoes = [];

        foreach (array_filter($nomes) as $nome) {
            if (! is_file("{$pasta}/{$nome}")) {
                throw new InvalidArgumentException("{$pasta}: a imagem '{$nome}' não existe");
            }
            [$largura, $altura] = getimagesize("{$pasta}/{$nome}");
            $dimensoes[$nome] = [$largura, $altura];
        }

        return $dimensoes;
    }

    /** "./capa.png" vira "capa.png". */
    private function nomeDaImagem(?string $caminho): ?string
    {
        return $caminho === null ? null : basename($caminho);
    }
}
