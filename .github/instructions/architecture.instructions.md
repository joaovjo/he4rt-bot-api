---
applyTo: 'Heart/**/*.php'
---

# Architecture Guidelines

## DDD Structure
Backend follows a Laravel 12 DDD layout under `Heart/<Domain>` split into:
- `Application`: Use cases and orchestration (e.g., `ClaimDailyBonus`, `FindProvider`)
- `Domain`: Business logic, entities, repositories, actions, and exceptions
- `Infrastructure`: Persistence, models, factories, and providers
- `Presentation`: Controllers, requests, and HTTP layer

Mirror this structure for new features instead of using `app/`.

## Domain Registration
`Heart\Core\Classes\DomainManager` scans for `*Domain.php` classes and registers the providers each domain lists in `registerProvider()`.

Add new service or route providers by updating the domain class (e.g., `CharacterDomain`), not the global bootstrap code.

## Dependency Injection
Domain providers bind interfaces to concrete implementations:
- Example: `Heart\Character\Infrastructure\Providers\CharacterServiceProvider` binds `CharacterRepository` to `CharacterEloquentRepository`
- Keep repository contracts in `Domain\Repositories` and wire them in service providers

## Entities
Domain entities expose named constructors like `::make()` and wrap value objects.

Build responses via these entities instead of returning raw Eloquent arrays.
