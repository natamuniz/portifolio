---
titulo: GED
codigo: PRJ-004
ano: 2026
tipo: Full-stack
resumo: Gestão eletrônica de documentos com API Laravel e interface Vue. Versionamento de arquivos, verificação de integridade, permissões por unidade e compartilhamento temporário com auditoria.
papel: Projeto pessoal de estudo, da modelagem à API e à interface
stack: [Laravel 13, PHP 8.4, PostgreSQL 17, Vue 3, TypeScript, Docker]
repositorio: https://github.com/natamuniz/ged
selo: Em desenvolvimento
capa: ./capa.jpg
capaAlt: Painel do GED com indicadores do acervo, documentos por tipo e abrangência de acesso da unidade Financeiro
galeria:
  - src: ./versoes.jpg
    alt: Histórico de versões de um documento no GED
  - src: ./compartilhamento.jpg
    alt: Interface de compartilhamento temporário de uma versão de documento no GED
  - src: ./mobile.jpg
    alt: Interface do GED em uma tela de celular
destaque: true
ordem: 4
---

## O problema

Um acervo digital precisa manter o histórico dos arquivos, controlar o acesso entre unidades e permitir o compartilhamento de uma versão sem abrir todo o documento. Também precisa registrar as operações e detectar quando um arquivo já não corresponde ao conteúdo armazenado originalmente.

Criei o GED como projeto pessoal de estudo para trabalhar essas regras em uma API Laravel, com PostgreSQL e uma interface separada em Vue e TypeScript.

## O que eu fiz

- **Acervo com versões:** cadastro de documentos, envio de novas versões, filtros, paginação e download autorizado de arquivos privados.
- **Permissões por unidade:** quatro perfis, concessões e bloqueios individuais, com abrangência herdada apenas pelas unidades descendentes.
- **Verificação de integridade:** SHA-256 registrado no upload e conferência em segundo plano, distinguindo correspondência, divergência e falha de leitura.
- **Compartilhamento temporário:** acesso a uma versão específica para destinatários autenticados, com agendamento, expiração, revogação e histórico de acessos.
- **Auditoria na API:** consulta de eventos com filtros e controle de abrangência, além de registro de alterações e downloads autorizados.
- **Interface responsiva:** painel do acervo, consulta de documentos, histórico de versões e fluxos de compartilhamento, com navegação adaptada ao celular.

## Decisões técnicas

- **API e interface separadas:** Laravel concentra a autorização; o Vue apresenta as ações conforme as permissões retornadas pela API.
- **Sessão com Sanctum:** autenticação por cookies e proteção CSRF, sem guardar tokens no localStorage.
- **Consistência entre banco e arquivos:** compensação de arquivos quando o cadastro falha e bloqueio transacional para numerar novas versões.
- **Links com acesso restrito:** o token de compartilhamento é persistido como hash, e o download revalida o destinatário, o prazo e a autorização do criador.
- **Ambiente reproduzível:** Docker Compose reúne API, PostgreSQL, worker e frontend; os testes de backend usam um banco PostgreSQL separado.

## Estado do projeto

O GED está em desenvolvimento, com código aberto sob GPL-3.0-or-later. A API já inclui administração, arquivamento, restauração e consulta de auditoria; as telas desses fluxos estão entre as próximas etapas do MVP.

As capturas usam dados fictícios de validação. A verificação por hash detecta alterações em relação ao valor registrado; assinatura digital fica para uma etapa futura.
