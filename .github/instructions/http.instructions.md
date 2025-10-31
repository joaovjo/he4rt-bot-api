---
applyTo: 'Heart/**/Presentation/**/*.php'
---

# HTTP & Middleware Guidelines

## Controllers
- Controllers live in `Heart/<Domain>/Presentation/Controllers`
- Extend `App\Http\Controllers\Controller`
- Delegate work to injected action classes (see `CharactersController` using `PaginateCharacters`, `FindCharacter`, `ClaimDailyBonus`)
- Keep controllers thin—business logic belongs in Application or Domain layers

## Validation
- Validation belongs to `Presentation\Requests` form requests
- Avoid inline validation logic inside controllers
- Example: `ClaimBadgeRequest` validates `redeem_code` field

## Routes
- Routes are registered in `Infrastructure\Providers\<Domain>RouteProvider`
- Always use `/api` prefix with `'bot-auth'` middleware alias plus `api` stack
- Follow naming patterns like `characters.dailyReward` when adding endpoints
- Example route definition:
  ```php
  Route::prefix('api')->middleware(['api', 'bot-auth'])->group(function (): void {
      Route::prefix('characters')->group(function (): void {
          Route::post('/{provider}/{providerId}/daily', [CharactersController::class, 'postDailyBonus'])
              ->name('characters.dailyReward');
      });
  });
  ```

## Authentication
- `App\Http\Middleware\BotAuthentication` enforces `X-He4rt-Authorization` header against `config('he4rt.server_key')`
- Feature tests should call `$this->actingAsAdmin()` (defined in `tests/TestCase`) to attach the header
- The middleware checks for presence and validity of the header before allowing access
