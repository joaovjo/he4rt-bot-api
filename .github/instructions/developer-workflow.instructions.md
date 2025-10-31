---
applyTo: '**/*'
---

# Developer Workflow Guidelines

## Setup
- `make setup` (or `composer run-script setup`) installs Composer/NPM deps, runs key generation, storage link, migrations, and IDE helper generation in one step
- First-time setup: ensure Docker is running before `make env-up`

## Development Environment
- Use `make env-up` / `make env-down` to spin up/down Postgres, Redis, and Mailpit containers defined in `docker-compose.yml`
- Containers: PostgreSQL 18, Redis 8, Mailpit for email testing
- All services accessible on localhost with default ports

## Development Loop
- Start full dev loop with `composer run dev` (aliased by `make dev`)
- This runs via `concurrently`:
  - HTTP server (`php artisan serve`)
  - Queue listener (`php artisan queue:listen --tries=1`)
  - Laravel Pail log tail (`php artisan pail --timeout=0`)
  - Vite watcher (`npm run dev`)

## Quality Gates
Quality gates live in Makefile and Composer scripts:
- `make check`: runs Rector (dry-run), Pint (test), and PHPStan
- `make format`: runs Rector and Pint to fix code style
- `make test`: runs all Pest tests with `RefreshDatabase`
- `make test-unit`: runs unit tests only (group=unit)
- `make test-feature`: runs feature tests only (group=feature)
- Module tests under `app-modules/*/tests` are included automatically

## Configuration
- Configuration such as `HE4RT_BOT_SECRET`, season metadata, and Discord IDs comes from `config/he4rt.php`
- Read values through `config()` instead of `env()` in runtime code
- Example: `config('he4rt.server_key')` not `env('HE4RT_BOT_SECRET')`
- Environment-specific overrides go in `.env` (local), `.env.testing` (tests), or `.env.pipeline` (CI)
