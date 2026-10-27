---
titulo: Arquiva
codigo: PRJ-001
ano: 2026
tipo: API
resumo: API open-source de gestão documental, com plano de classificação em árvore, tabela de temporalidade versionada, sigilo em dois níveis e auditoria imutável.
papel: Projeto pessoal, do modelo de dados aos testes
stack: [Laravel 13, PostgreSQL 16, Docker, PHPUnit, PHPStan]
repositorio: https://github.com/natamuniz/arquiva
selo: Destaque
destaque: true
ordem: 1
previa: |
  GET /api/documentos?classe=010.1
  {
    "codigo": "010.1.1",
    "sigilo": "reservado",
    "status": "capturado",
    "regra_vigente": { "versao": 3 },
    "sha256": "9f3c…e21a ✓"
  }
---

## O problema

Órgãos e empresas precisam guardar documentos por prazos definidos em lei, saber quem pode ver cada um, provar que nada foi adulterado e responder "quem fez o quê, quando". Um CRUD com upload não resolve isso: as regras mudam com o tempo, o acesso depende do sigilo e da unidade, e banco e disco precisam ficar consistentes mesmo quando algo falha no meio.

## O que a API faz

- **Autenticação por token** (Sanctum), com expiração de 24 h e limite de tentativas de login.
- **Quatro perfis** (admin, gestor, operador, consulta) e usuários ligados a uma unidade.
- **Sigilo em dois níveis:** ver os metadados é diferente de baixar o arquivo.
- **Plano de classificação** em árvore (`010 > 010.1 > 010.1.1`), com importação CSV tudo-ou-nada.
- **Tabela de temporalidade versionada:** dá para perguntar qual regra valia em qualquer data.
- **Fixidez diária:** recalcula o SHA-256 de todos os arquivos e registra corrupção ou ausência.
- **Auditoria imutável** de alterações, logins e downloads.
- **Busca sem acento:** `licitacao` encontra "Licitação".

## Decisões técnicas

Cada decisão tem um teste que a comprova.

- **Índice único parcial** no PostgreSQL garante uma única regra vigente por classe, mesmo em condição de corrida.
- **Banco antes do disco:** o arquivo físico só é apagado depois do commit; se a transação falhar, ele continua lá.
- **404 para o que você não vê, 403 para o que você vê mas não pode fazer:** um documento sigiloso de outra unidade nem revela que existe.
- **Larastan nível 8:** nenhum SQL bruto recebe texto vindo da requisição.

> Projeto de portfólio, escrito do zero com dados 100% fictícios.
