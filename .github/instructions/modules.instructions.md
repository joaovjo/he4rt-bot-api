---
applyTo: 'app-modules/**/*.php'
---

# Modules & Legacy Code Guidelines

## App Modules
- Shared packages under `app-modules/*` are local Composer libraries
- Each module has its own `Providers` and `routes/*-routes.php`
- Load middleware via class references (see `app-modules/message/routes/message-routes.php`)
- Example:
  ```php
  use App\Http\Middleware\BotAuthentication;
  
  Route::prefix('api')->middleware(['api', BotAuthentication::class])->group(function (): void {
      // module routes
  });
  ```
- Keep API conventions aligned with core `Heart` domains

## Legacy Endpoints
- Legacy Lumen endpoints remain in `routes/old-api.php`
- Treat them as read-only unless migrating functionality into new `Heart` domains
- When migrating, create equivalent domain structure and gradually deprecate old routes

## Provider Registration
- Global providers load from `bootstrap/providers.php`
- `Heart\Core\Providers\CoreProvider` is already registered there
- Prefer extending domain registrations over editing `config/app.php` directly
- Domain-specific providers are auto-discovered by `DomainManager`
