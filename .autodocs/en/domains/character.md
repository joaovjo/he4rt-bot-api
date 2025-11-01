---
tags: [domain]
aliases: [Character]
related:
  - "[[architecture]]"
---

# Character

> [!info] Metadata
> Type: Domain
> Location: `Heart/Character`
> Status: Active

## Overview
Character progression, badges and stats.

## File Structure
```
Character/
├── Application/
│   ├── ClaimCharacterBadge.php
│   ├── ClaimDailyBonus.php
│   ├── FindCharacterIdByUserId.php
│   └── (other use cases)
├── Domain/
│   ├── Actions/
│   │   ├── FindCharacter.php
│   │   ├── GetCharacterByUserId.php
│   │   ├── IncrementExperience.php
│   │   ├── ManageReputation.php
│   │   ├── PaginateCharacters.php
│   │   ├── PersistClaimedBadge.php
│   │   └── PersistDailyBonus.php
│   ├── Collections/
│   │   └── PastSeasonCollection.php
│   ├── Entities/
│   │   ├── CharacterEntity.php
│   │   ├── DailyRewardEntity.php
│   │   ├── LevelEntity.php
│   │   ├── PastSeasonEntity.php
│   │   └── ReputationEntity.php
│   ├── Enums/
│   │   └── VoiceStatesEnum.php
│   ├── Exceptions/
│   │   ├── CharacterException.php
│   │   └── LevelException.php
│   └── Repositories/
│       └── CharacterRepository.php
├── Infrastructure/
│   ├── Factories/
│   │   ├── CharacterFactory.php
│   │   ├── PastSeasonFactory.php
│   │   └── WalletFactory.php
│   ├── Models/
│   │   ├── Character.php
│   │   ├── PastSeason.php
│   │   └── Wallet.php
│   ├── Providers/
│   │   ├── CharacterRouteProvider.php
│   │   └── CharacterServiceProvider.php
│   └── Repositories/
│       └── CharacterEloquentRepository.php
└── Presentation/
  ├── Controllers/
  │   └── CharactersController.php
  └── Requests/
    └── ClaimBadgeRequest.php
```

## Tags
#domain
