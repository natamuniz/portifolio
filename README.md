# Portfólio · Natã Muniz

Site pessoal feito em **Laravel 13** com **Blade**, no ar em [natamunizdev.com.br](https://natamunizdev.com.br). Fundo escuro, verde-limão e um "arquivo" de projetos: cada projeto é um registro com código (PRJ-001), ficha e página própria.

O site não tem login nem banco de dados, então o Laravel gera as páginas prontas (HTML) e a Cloudflare Pages só serve os arquivos. É de graça e carrega rápido.

## Rodar no computador

Precisa de PHP 8.3+ (com a extensão `gd`) e Composer.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve        # abre em http://localhost:8000
```

Outros comandos:

```bash
php artisan test         # roda os testes
vendor/bin/pint          # arruma o estilo do código
php artisan site:gerar   # gera o site estático em dist/
```

## Como o código está organizado

| Onde | O que tem |
| --- | --- |
| `config/perfil.php` | Seus dados: nome, links, Sobre, habilidades, trajetória e formação |
| `resources/content/projetos/<projeto>/` | Um projeto por pasta: `index.md` e as imagens |
| `app/Portfolio/` | `RepositorioProjetos` lê as pastas; `Projeto` é cada registro |
| `app/Http/Controllers/` | Home, página do projeto, sitemap e imagens em WebP |
| `app/Console/Commands/GerarSite.php` | O comando `site:gerar`, que salva cada página em `dist/` |
| `resources/views/` | As telas em Blade; cada seção da home é um componente em `components/` |
| `public/css/site.css` e `public/js/site.js` | Estilo e o pouco de JavaScript do site (menu e formulário) |

As imagens dos projetos são convertidas para WebP em 400, 800 e 1440 px na hora de gerar o site, sem nunca aumentar uma imagem pequena.

## Adicionar um projeto novo

1. Crie a pasta `resources/content/projetos/nome-do-projeto/`.
2. Dentro dela, crie um `index.md` como este e coloque as imagens ao lado:

```markdown
---
titulo: Nome do Projeto
codigo: PRJ-004
ano: 2026
tipo: Site            # API, Site, Automação, Front-end...
resumo: Uma ou duas frases sobre o projeto.
papel: Design e desenvolvimento
stack: [Laravel, PostgreSQL]
link: https://...             # opcional: site no ar
repositorio: https://github.com/natamuniz/...   # opcional
selo: Novo                    # opcional: etiqueta no card
capa: ./capa.png              # opcional: sem capa, use "previa" com um trecho de código
capaAlt: Descrição da imagem
destaque: true                # true = card grande na home; false = lista "Outros registros"
ordem: 4                      # ordem entre os destaques
---

## O problema

...

## O que eu fiz

...
```

3. Faça o commit e o push na `main`. O GitHub testa, gera o site e publica sozinho.

Se faltar um campo obrigatório (título, código, ano, tipo ou resumo) ou uma imagem citada não existir, a geração para com um aviso em vez de publicar uma página quebrada.

## Editar seus dados

Tudo o que é pessoal fica em `config/perfil.php`:

- `sobre`: os parágrafos do "Sobre";
- `trajetoria`: a lista que aparece como `git log`;
- `email`, `foto`, `curriculo`: vazios ficam escondidos no site;
- `formulario`: endereço de um serviço como o Formspree. Sem ele, mas com e-mail, o formulário abre o e-mail da pessoa já preenchido. Sem os dois, aparece um botão para o LinkedIn.

Foto e currículo vão na pasta `public/` (por exemplo `public/foto.jpg` e `'foto' => '/foto.jpg'`).

## Como o site é publicado

1. A cada push na `main`, o GitHub Actions (`.github/workflows/site.yml`) roda o Pint, os testes e o `php artisan site:gerar`.
2. O resultado vai para a branch `site`, com a pasta `dist/`.
3. A Cloudflare Pages está ligada à branch `site` e publica a pasta `dist/` em natamunizdev.com.br.

A Cloudflare não tem PHP no build, por isso as páginas são geradas no GitHub. Configuração na Cloudflare (Workers & Pages > portifolio > Settings > Builds):

- **Production branch:** `site`
- **Build command:** `npm run build` (na branch `site` ele não faz nada, o site já vem pronto)
- **Build output directory:** `dist`
- **Preview deployments:** desligado (`None`), porque as outras branches têm o código Laravel, não o site pronto.
