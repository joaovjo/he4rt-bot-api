---
tags: [domain]
aliases: [Temporadas]
related:
  - "[[architecture]]"
---

# Season

> [!info] Metadados
> **Tipo**: Domain
> **Localização**: `Heart/Season`
> **Status**: Active

## Visão Geral
[Descrição do domínio Season.]

## Estrutura de Arquivos
```
Season/
├── Application/
│   ├── GetCurrentSeason.php
│   └── GetSeasons.php
├── Domain/
│   ├── Collections/
│   │   └── SeasonCollection.php
│   ├── Entities/
│   │   └── SeasonEntity.php
│   ├── Exceptions/
│   │   └── SeasonException.php
│   └── Repositories/
│       └── SeasonRepository.php
├── Infrastructure/
│   ├── Factories/
│   │   └── SeasonFactory.php
│   ├── Models/
│   │   └── Season.php
│   ├── Providers/
│   │   ├── SeasonRouteProvider.php
│   │   └── SeasonServiceProvider.php
│   └── Repositories/
│       └── SeasonEloquentRepository.php
└── Presentation/
  └── Controllers/
    └── SeasonsController.php
```

## Organização Arquitetural
- Application: consultas de temporadas
- Domain: entidades, repositório, coleção e exceções
- Infrastructure: model, factory, repositório e providers
- Presentation: controller HTTP

## Tags
#domain #season