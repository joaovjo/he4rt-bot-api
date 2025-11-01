---
tags: [domain]
aliases: [Seasons]
related:
  - "[[architecture]]"
---

# Season

> [!info] Metadata
> Type: Domain
> Location: `Heart/Season`
> Status: Active

## Overview
Seasons listing and current season lookup.

## File Structure
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

## Tags
#domain #season
