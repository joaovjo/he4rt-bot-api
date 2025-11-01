---
tags: [domain]
aliases: [Shared]
related:
  - "[[architecture]]"
---

# Shared

> [!info] Metadata
> Type: Domain
> Location: `Heart/Shared`
> Status: Active

## Overview
Cross-domain utilities: pagination abstractions, basic value objects and infrastructure helpers.

## File Structure
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

## Architectural Organization
- Application
  - TTL: Simple time converters (minutes/hours/days → seconds)
- Domain
  - Paginator: Contract for pagination similar to Laravel's LengthAwarePaginator
  - ValueObjects: Base types for string/int VOs
- Infrastructure
  - Paginator: Adapter extending Laravel's LengthAwarePaginator and implementing `Shared\\Domain\\Paginator`

## Tags
#domain #shared
