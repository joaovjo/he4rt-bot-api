---
applyTo: 'Heart/**/Infrastructure/**/*.php'
---

# Data & Integration Guidelines

## Persistence
- Persistence lives in `Infrastructure\Models` with Eloquent models
- Factories live in `Infrastructure\Factories` extending `Heart\Shared\Infrastructure\Factory`
- The shared Factory class pins the `testing` connection for test isolation
- Use these factories for seeding state in tests

## Repository Pattern
- Repository interfaces return domain aggregates or `Heart\Shared\Domain\Paginator`
- Adapt Eloquent paginators with `Heart\Shared\Infrastructure\Paginator::paginate()` so JSON responses stay consistent
- Example:
  ```php
  public function paginate(int $perPage = 10): LengthAwarePaginator
  {
      $paginator = Character::query()->paginate($perPage);
      return PaginatorConcrete::paginate($paginator);
  }
  ```

## Application Layer Orchestration
- Application actions handle caching and orchestration
- Follow patterns like `FindProvider` and `FindCharacterIdByUserId`:
  - Wrap `Cache::remember()` around domain actions
  - Use `Heart\Shared\Application\TTL` helpers instead of hardcoded durations
  - Example: `TTL::fromDays(2)`, `TTL::fromHours(1)`

## Cross-Domain Interactions
- Cross-domain interactions should flow through the `Application` layer
- Example: claiming a character bonus resolves providers through `FindProvider` before hitting `PersistDailyBonus`
- Avoid coupling controllers straight to models from other domains
- Keep domain boundaries clean by injecting Application-layer actions
