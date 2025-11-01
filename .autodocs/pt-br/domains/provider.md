---
tags: [domain]
aliases: [Provedores]
related:
  - "[[architecture]]"
---

# Provider

> [!info] Metadados
> **Tipo**: Domain
> **Localização**: `Heart/Provider`
> **Status**: Active

## Visão Geral
[Descrição do domínio Provider.]

## Estrutura de Arquivos
```
Provider/
├── Application/
│   ├── FindProvider.php
│   └── NewAccountByProvider.php
├── Domain/
│   ├── Actions/
│   │   └── GetProviderById.php
│   ├── DTOs/
│   │   └── NewProviderDTO.php
│   ├── Entities/
│   │   └── ProviderEntity.php
│   ├── Enums/
│   │   └── ProviderEnum.php
│   ├── Repositories/
│   │   ├── ProviderRepository.php
│   │   └── TokenRepository.php
│   └── ValueObjects/
│       └── ProviderData.php
└── Infrastructure/
  ├── Exceptions/
  │   └── ProviderException.php
  ├── Factories/
  │   ├── ProviderFactory.php
  │   └── TokenFactory.php
  ├── Models/
  │   ├── Provider.php
  │   └── Token.php
  ├── Providers/
  │   ├── ProviderRouteProvider.php
  │   └── ProviderServiceProvider.php
  └── Repositories/
    ├── ProviderEloquentRepository.php
    └── TokenEloquentRepository.php
```

## Organização Arquitetural
- Application: criação e busca por provider
- Domain: entidades, DTOs, VOs, repositórios e enums
- Infrastructure: models, factories, exceptions, repos e providers
- Presentation: controllers e requests (ver arquivos em Presentation/)

## Tags
#domain #provider