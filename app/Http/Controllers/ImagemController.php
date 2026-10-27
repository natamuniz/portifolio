<?php

namespace App\Http\Controllers;

use App\Portfolio\RepositorioProjetos;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Entrega as imagens dos projetos em WebP, na largura pedida.
 * A conversão fica guardada em storage/framework/imagens e só é refeita se o original mudar.
 */
class ImagemController extends Controller
{
    /** Larguras aceitas, para ninguém pedir tamanhos arbitrários. */
    public const LARGURAS = [400, 800, 1440];

    public function __invoke(RepositorioProjetos $projetos, string $slug, string $nome, int $largura): BinaryFileResponse
    {
        $original = $projetos->arquivoDeImagem($slug, $nome);

        abort_if($original === null || ! in_array($largura, self::LARGURAS, true), 404);

        $destino = storage_path("framework/imagens/{$slug}/{$nome}-{$largura}.webp");

        if (! is_file($destino) || filemtime($destino) < filemtime($original)) {
            $this->converter($original, $destino, $largura);
        }

        return response()->file($destino, ['Content-Type' => 'image/webp']);
    }

    private function converter(string $original, string $destino, int $largura): void
    {
        $imagem = imagecreatefromstring(file_get_contents($original));

        // Nunca aumenta a imagem: se o original for menor, fica no tamanho dele.
        if (imagesx($imagem) > $largura) {
            $imagem = imagescale($imagem, $largura);
        }

        if (! is_dir(dirname($destino))) {
            mkdir(dirname($destino), 0755, true);
        }

        imagewebp($imagem, $destino, 82);
    }
}
