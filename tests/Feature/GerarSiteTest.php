<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class GerarSiteTest extends TestCase
{
    private string $destino = 'storage/framework/testing/site';

    protected function tearDown(): void
    {
        File::deleteDirectory(base_path($this->destino));

        parent::tearDown();
    }

    public function test_gera_todas_as_paginas_imagens_e_arquivos_publicos(): void
    {
        $this->artisan('site:gerar', ['--destino' => $this->destino])->assertSuccessful();

        $site = base_path($this->destino);

        foreach ([
            'index.html',
            '404.html',
            'sitemap.xml',
            'robots.txt',
            'curriculo.pdf',
            'css/site.css',
            'projetos/arquiva/index.html',
            'projetos/forte-do-forno/index.html',
            'projetos/ged/index.html',
            'img/projetos/ged/capa-800.webp',
            'img/projetos/ged/versoes-800.webp',
            'img/projetos/ged/compartilhamento-800.webp',
            'img/projetos/ged/mobile-800.webp',
            'img/projetos/forte-do-forno/capa-800.webp',
        ] as $arquivo) {
            $this->assertFileExists("{$site}/{$arquivo}");
        }

        $this->assertFileDoesNotExist("{$site}/index.php");
        $this->assertStringContainsString('registro não encontrado', File::get("{$site}/404.html"));
    }
}
