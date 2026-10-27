<?php

namespace Tests\Feature;

use Tests\TestCase;

class ImagemTest extends TestCase
{
    public function test_converte_a_imagem_para_webp_na_largura_pedida(): void
    {
        $resposta = $this->get('/img/projetos/forte-do-forno/capa-400.webp')
            ->assertOk()
            ->assertHeader('Content-Type', 'image/webp');

        [$largura] = getimagesize($resposta->baseResponse->getFile()->getPathname());
        $this->assertSame(400, $largura);
    }

    public function test_nunca_aumenta_uma_imagem_menor_que_a_largura_pedida(): void
    {
        $resposta = $this->get('/img/projetos/forte-do-forno/mobile-800.webp')->assertOk();

        [$largura] = getimagesize($resposta->baseResponse->getFile()->getPathname());
        $this->assertSame(390, $largura);
    }

    public function test_recusa_larguras_fora_da_lista_e_imagens_que_nao_existem(): void
    {
        $this->get('/img/projetos/forte-do-forno/capa-123.webp')->assertNotFound();
        $this->get('/img/projetos/forte-do-forno/nada-400.webp')->assertNotFound();
    }
}
