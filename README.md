# Portfólio · Natã Muniz

Site pessoal feito em [Astro](https://astro.build). Fundo escuro, verde-limão e um "arquivo" de projetos: cada projeto é um registro com código (PRJ-001), ficha e página própria.

## Rodar no computador

```bash
npm install
npm run dev      # abre em http://localhost:4321
npm run build    # gera o site em dist/
```

## Adicionar um projeto novo

1. Crie a pasta `src/content/projetos/nome-do-projeto/`.
2. Dentro dela, crie um `index.md` como este e coloque as imagens ao lado:

```markdown
---
titulo: Nome do Projeto
codigo: PRJ-003
ano: 2026
tipo: Site            # API, Site, Automação, Front-end...
resumo: Uma ou duas frases sobre o projeto.
papel: Design e desenvolvimento
stack: [Astro, Tailwind]
link: https://...             # opcional: site no ar
repositorio: https://github.com/natamuniz/...   # opcional
selo: Novo                    # opcional: etiqueta no card
capa: ./capa.png              # opcional: sem capa, use "previa" com um trecho de código
capaAlt: Descrição da imagem
destaque: true                # true = card grande na home; false = lista "Outros registros"
ordem: 3                      # ordem entre os destaques
---

## O problema

...

## O que eu fiz

...
```

3. Faça o commit e o push. A Vercel publica sozinha.

Se faltar um campo obrigatório (título, código, ano, tipo ou resumo), o build avisa em vez de publicar uma página quebrada. O espaço "Próximo registro" na home sempre mostra o próximo código livre.

## Editar seus dados

Tudo o que é pessoal fica em `src/data/perfil.ts`:

- `sobre`: os parágrafos do "Sobre" (cole o texto do LinkedIn aqui);
- `trajetoria`: a lista que aparece como `git log` (adicione experiências profissionais);
- `email`, `foto`, `curriculo`: vazios ficam escondidos no site;
- `formulario`: endereço de um serviço como o Formspree. Sem ele, mas com e-mail, o formulário abre o e-mail da pessoa já preenchido. Sem os dois, aparece um botão para o LinkedIn.

Foto e currículo vão na pasta `public/` (por exemplo `public/foto.jpg` e `foto: '/foto.jpg'`).

## Publicar na Vercel

1. Em vercel.com, **Add New > Project** e importe este repositório.
2. A Vercel detecta o Astro sozinha; não precisa mudar nada.
3. Quando tiver o endereço final, troque `site` em `astro.config.mjs`.
