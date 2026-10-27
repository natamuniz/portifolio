<?php

namespace App\Portfolio;

use Illuminate\Support\Str;

/**
 * Um projeto do portfólio, lido de resources/content/projetos/<slug>/index.md.
 */
final readonly class Projeto
{
    /**
     * @param  list<string>  $stack
     * @param  list<array{arquivo: string, alt: string}>  $galeria
     * @param  array<string, array{0: int, 1: int}>  $dimensoes  largura e altura originais de cada imagem
     */
    public function __construct(
        public string $slug,
        public string $titulo,
        public string $codigo,
        public int $ano,
        public string $tipo,
        public string $resumo,
        public ?string $papel,
        public array $stack,
        public ?string $link,
        public ?string $repositorio,
        public ?string $selo,
        public ?string $capa,
        public ?string $capaAlt,
        public ?string $previa,
        public array $galeria,
        public bool $destaque,
        public int $ordem,
        public string $corpo,
        public array $dimensoes = [],
    ) {}

    public function url(): string
    {
        return "/projetos/{$this->slug}/";
    }

    public function corpoHtml(): string
    {
        return trim($this->corpo) === '' ? '' : Str::markdown($this->corpo);
    }

    /** Endereço de uma imagem do projeto convertida para WebP na largura pedida. */
    public function imagem(string $arquivo, int $largura): string
    {
        $nome = pathinfo($arquivo, PATHINFO_FILENAME);

        return "/img/projetos/{$this->slug}/{$nome}-{$largura}.webp";
    }

    /**
     * Lista de tamanhos para o atributo srcset. Uma imagem nunca é aumentada,
     * então larguras maiores que a original são descritas com a largura real.
     *
     * @param  list<int>  $larguras
     */
    public function srcset(string $arquivo, array $larguras): string
    {
        $original = $this->dimensoes[$arquivo][0] ?? PHP_INT_MAX;

        return collect($larguras)
            ->mapWithKeys(fn (int $l) => [min($l, $original) => $this->imagem($arquivo, $l)])
            ->map(fn (string $url, int $real) => "{$url} {$real}w")
            ->implode(', ');
    }

    /** Atributos width e height da imagem original, para o navegador reservar o espaço. */
    public function tamanho(string $arquivo): string
    {
        [$largura, $altura] = $this->dimensoes[$arquivo] ?? [null, null];

        return $largura ? "width=\"{$largura}\" height=\"{$altura}\"" : '';
    }

    /** Texto do rodapé do card: o link ao vivo, o repositório ou "repositório privado". */
    public function enderecoCurto(): string
    {
        $url = $this->link ?? $this->repositorio;

        if ($url === null) {
            return 'repositório privado';
        }

        return rtrim(preg_replace('#^https?://#', '', $url), '/');
    }
}
