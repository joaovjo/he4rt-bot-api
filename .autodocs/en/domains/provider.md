---
tags: [domain]
aliases: [Providers]
related:
  - "[[architecture]]"
---

# Provider

> [!info] Metadata
> Type: Domain
> Location: `Heart/Provider`
> Status: Active

## Overview
Provider accounts (Discord, Twitch) linked to users.

## File Structure
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

## Tags
#domain #provider
