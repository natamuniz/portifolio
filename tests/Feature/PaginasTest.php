<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaginasTest extends TestCase
{
    public function test_a_pagina_inicial_mostra_os_projetos_e_os_contatos(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSeeInOrder(['Arquiva', 'Forte do Forno', 'ChegouAqui'])
            ->assertSee('Outros registros do arquivo')
            ->assertSee('href="https://www.linkedin.com/in/nata-muniz/"', false)
            ->assertSee('download="Curriculo-Nata-Muniz.pdf"', false)
            ->assertSee('<link rel="canonical" href="https://natamunizdev.com.br/" />', false);
    }

    public function test_a_pagina_de_um_projeto_mostra_a_ficha_e_o_texto(): void
    {
        $this->get('/projetos/arquiva/')
            ->assertOk()
            ->assertSee('<h1 class="prj__titulo">Arquiva</h1>', false)
            ->assertSee('Código no GitHub')
            ->assertSee('<h2>Decisões técnicas</h2>', false)
            ->assertSee('<link rel="canonical" href="https://natamunizdev.com.br/projetos/arquiva/" />', false);
    }

    public function test_projeto_com_capa_usa_imagens_webp_com_tamanho_definido(): void
    {
        $this->get('/projetos/forte-do-forno/')
            ->assertOk()
            ->assertSee('/img/projetos/forte-do-forno/capa-1440.webp 1440w', false)
            ->assertSee('width="1440" height="900"', false);
    }

    public function test_projeto_inexistente_mostra_a_pagina_404(): void
    {
        $this->get('/projetos/nao-existe/')
            ->assertNotFound()
            ->assertSee('registro não encontrado (404)');
    }

    public function test_o_sitemap_lista_a_home_e_todos_os_projetos(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertSee('<loc>https://natamunizdev.com.br/</loc>', false)
            ->assertSee('<loc>https://natamunizdev.com.br/projetos/chegouaqui/</loc>', false);
    }
}
