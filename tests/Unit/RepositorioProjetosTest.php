<?php

namespace Tests\Unit;

use App\Portfolio\RepositorioProjetos;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;
use Tests\TestCase;

class RepositorioProjetosTest extends TestCase
{
    private string $pasta;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pasta = storage_path('framework/testing/projetos');
        File::deleteDirectory($this->pasta);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->pasta);
        parent::tearDown();
    }

    private function projeto(string $slug, string $cabecalho, string $corpo = ''): void
    {
        File::ensureDirectoryExists("{$this->pasta}/{$slug}");
        File::put("{$this->pasta}/{$slug}/index.md", "---\n{$cabecalho}\n---\n{$corpo}");
    }

    public function test_le_o_cabecalho_e_o_texto_em_markdown(): void
    {
        $this->projeto('api', "titulo: API\ncodigo: PRJ-001\nano: 2026\ntipo: API\nresumo: Uma API.\nstack: [Laravel, PostgreSQL]", "## Problema\n\nTexto.");

        $projeto = (new RepositorioProjetos($this->pasta))->encontrar('api');

        $this->assertSame('API', $projeto->titulo);
        $this->assertSame(['Laravel', 'PostgreSQL'], $projeto->stack);
        $this->assertSame('/projetos/api/', $projeto->url());
        $this->assertStringContainsString('<h2>Problema</h2>', $projeto->corpoHtml());
        $this->assertSame('repositório privado', $projeto->enderecoCurto());
    }

    public function test_destaques_vem_pela_ordem_e_os_outros_pelo_codigo(): void
    {
        $this->projeto('b', "titulo: B\ncodigo: PRJ-002\nano: 2026\ntipo: Site\nresumo: B\ndestaque: true\nordem: 2");
        $this->projeto('a', "titulo: A\ncodigo: PRJ-001\nano: 2026\ntipo: API\nresumo: A\ndestaque: true\nordem: 1");
        $this->projeto('y', "titulo: Y\ncodigo: PRJ-000b\nano: 2023\ntipo: Front\nresumo: Y");
        $this->projeto('x', "titulo: X\ncodigo: PRJ-000a\nano: 2024\ntipo: Front\nresumo: X");

        $repositorio = new RepositorioProjetos($this->pasta);

        $this->assertSame(['a', 'b'], $repositorio->destaques()->pluck('slug')->all());
        $this->assertSame(['x', 'y'], $repositorio->outros()->pluck('slug')->all());
        $this->assertSame(['a', 'b', 'x', 'y'], $repositorio->todos()->pluck('slug')->all());
    }

    public function test_avisa_quando_falta_um_campo_obrigatorio(): void
    {
        $this->projeto('sem-resumo', "titulo: Sem resumo\ncodigo: PRJ-009\nano: 2026\ntipo: API");

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("o campo 'resumo' é obrigatório");

        (new RepositorioProjetos($this->pasta))->todos();
    }

    public function test_avisa_quando_a_imagem_da_capa_nao_existe(): void
    {
        $this->projeto('sem-imagem', "titulo: X\ncodigo: PRJ-009\nano: 2026\ntipo: Site\nresumo: X\ncapa: ./capa.png");

        $this->expectExceptionMessage("a imagem 'capa.png' não existe");

        (new RepositorioProjetos($this->pasta))->todos();
    }
}
