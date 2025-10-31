# He4rt Bot API – Copilot instructions

## Architecture
- Backend follows a Laravel 12 DDD layout under `Heart/<Domain>` split into `Application`, `Domain`, `Infrastructure`, and `Presentation`; mirror this structure for new features instead of using `app/`.
- `Heart\Core\Classes\DomainManager` scans for `*Domain.php` classes and registers the providers each domain lists in `registerProvider()`—add new service or route providers by updating the domain class, not the global bootstrap code.
- Domain providers bind interfaces to concrete implementations (e.g., `Heart\Character\Infrastructure\Providers\CharacterServiceProvider` binds `CharacterRepository` to the Eloquent repository); keep repository contracts in `Domain\Repositories` and wire them here.
- Domain entities expose named constructors like `::make()` and wrap value objects; build responses via these entities instead of returning raw Eloquent arrays.

## HTTP & Middleware
- Controllers live in `Heart/<Domain>/Presentation/Controllers`, extend `App\Http\Controllers\Controller`, and delegate work to injected action classes (see `CharactersController` using `PaginateCharacters`, `FindCharacter`, and `ClaimDailyBonus`).
- Validation belongs to `Presentation\Requests` form requests; avoid inline validation logic inside controllers.
- Routes are registered in `Infrastructure\Providers\<Domain>RouteProvider`, always under the `/api` prefix with the `'bot-auth'` middleware alias plus the `api` stack—reuse the existing naming patterns like `characters.dailyReward` when adding endpoints.
- `App\Http\Middleware\BotAuthentication` enforces the `X-He4rt-Authorization` header against `config('he4rt.server_key')`; feature tests should call `$this->actingAsAdmin()` (defined in `tests/TestCase`) to attach the header.

## Data & Integration
- Persistence lives in `Infrastructure\Models` with factories in `Infrastructure\Factories` extending `Heart\Shared\Infrastructure\Factory` (which pins the `testing` connection); use these factories for seeding state in tests.
- Repository interfaces return domain aggregates or `Heart\Shared\Domain\Paginator`; adapt Eloquent paginators with `Heart\Shared\Infrastructure\Paginator::paginate()` so JSON responses stay consistent.
- Application actions handle caching and orchestration—follow patterns like `FindProvider` and `FindCharacterIdByUserId` that wrap `Cache::remember()` around domain actions and rely on `Heart\Shared\Application\TTL` helpers instead of hardcoded durations.
- Cross-domain interactions should flow through the `Application` layer (e.g., claiming a character bonus resolves providers through `FindProvider` before hitting `PersistDailyBonus`); avoid coupling controllers straight to models from other domains.

## Modules & Legacy
- Shared packages under `app-modules/*` are local Composer libraries with their own `Providers` and `routes/*-routes.php`; load middleware via class references there (see `app-modules/message/routes/message-routes.php`) while keeping API conventions aligned with the core domains.
- Legacy Lumen endpoints remain in `routes/old-api.php`; treat them as read-only unless migrating functionality into the new `Heart` domains.
- Global providers load from `bootstrap/providers.php`, which already registers `Heart\Core\Providers\CoreProvider`; prefer extending domain registrations over editing `config/app.php` directly.

## Developer workflows
- `make setup` (or `composer run-script setup`) installs Composer/NPM deps, runs key generation, storage link, migrations, and IDE helper generation in one step.
- Use `make env-up`/`make env-down` to spin up the Postgres, Redis, and Mailpit containers defined in `docker-compose.yml` when developing locally.
- Start the full dev loop with `composer run dev` (aliased by `make dev`), which runs the HTTP server, queue listener, Laravel Pail log tail, and Vite watcher via `concurrently`.
- Quality gates live in the Makefile and Composer scripts: `make check` runs Rector (dry-run), Pint (test), and PHPStan; `make test`, `make test-unit`, and `make test-feature` execute Pest with `RefreshDatabase` and module tests under `app-modules/*/tests`.
- Configuration such as `HE4RT_BOT_SECRET`, season metadata, and Discord IDs comes from `config/he4rt.php`; read values through `config()` instead of `env()` in runtime code.
