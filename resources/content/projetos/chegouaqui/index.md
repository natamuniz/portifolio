---
titulo: ChegouAqui
codigo: PRJ-003
ano: 2026
tipo: SaaS
resumo: SaaS para portarias de condomínio registrarem encomendas, avisarem o morador pelo WhatsApp e acompanharem cada pacote até a retirada.
papel: Projeto pessoal, da arquitetura ao código
stack: [Django, DRF, PostgreSQL, Celery, Redis, Docker]
selo: Em construção
destaque: true
ordem: 3
previa: |
  POST /api/encomendas
  {
    "unidade": "Bloco B · 302",
    "transportadora": "Correios",
    "status": "aguardando_retirada"
  }
  → WhatsApp enviado ao morador ✓
---

## O problema

Em muitos condomínios, a portaria anota as encomendas num caderno e o morador só descobre que o pacote chegou quando passa por lá. Não há histórico de quem recebeu, quem retirou nem se um terceiro estava autorizado.

## Como funciona

1. O porteiro registra a encomenda recebida.
2. O sistema identifica a unidade e avisa o morador pelo WhatsApp.
3. Morador, portaria e administração acompanham o status.
4. A retirada é registrada, inclusive por terceiro autorizado.
5. Operações importantes ficam numa trilha de auditoria.

## Decisões técnicas

- **Multitenant por coluna:** cada condomínio é um tenant, e o isolamento é aplicado nas consultas, nas permissões, nos serviços e nos testes.
- **Monolito modular em Django:** apps separados por domínio (portaria, encomendas, notificações, auditoria), com as regras de negócio em serviços fora das views.
- **Avisos em segundo plano:** o envio pelo WhatsApp roda em filas com Celery e Redis.
- **LGPD e segredos:** dados pessoais mínimos e nenhum token ou senha no repositório.

> Em desenvolvimento. O repositório é privado por enquanto.
