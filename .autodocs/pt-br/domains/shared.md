---
tags: [domain]
aliases: [Compartilhado]
related:
  - "[[architecture]]"
---

# Shared

> [!info] Metadados
> **Tipo**: Domain
> **Localização**: `Heart/Shared`
> **Status**: Active

## Visão Geral
Utilitários compartilhados entre domínios: abstrações de paginação, value objects básicos e helpers de infraestrutura.

## Estrutura de Arquivos
```
Shared/
├── Application/
│   └── TTL.php
├── Domain/
│   ├── Paginator.php
│   └── ValueObjects/
│       ├── IntValueObject.php
│       └── StringValueObject.php
└── Infrastructure/
    ├── Factory.php
    └── Paginator.php
```

## Organização Arquitetural
- Application
  - TTL: Conversores simples de tempo (minutos/horas/dias → segundos)
- Domain
  - Paginator: Contrato para paginação com API similar ao LengthAwarePaginator
  - ValueObjects: Tipos base para VO de string/inteiro
- Infrastructure
  - Paginator: Adaptador que estende o LengthAwarePaginator do Laravel e implementa o contrato `Shared\Domain\Paginator`

## Tags
#domain #shared