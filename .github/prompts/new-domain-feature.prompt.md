---
agent: he4rt-bot
---

# Create a new domain feature

When implementing a new domain feature in the He4rt Bot API:

1. **Domain Structure**: Create the following directories under `Heart/<Domain>`:
   - `Application/` - use cases and orchestration
   - `Domain/Actions/` - business logic operations
   - `Domain/Entities/` - domain models with named constructors
   - `Domain/Repositories/` - interface contracts
   - `Domain/Exceptions/` - domain-specific exceptions
   - `Infrastructure/Models/` - Eloquent models
   - `Infrastructure/Repositories/` - repository implementations
   - `Infrastructure/Providers/` - service and route providers
   - `Infrastructure/Factories/` - test factories extending `Heart\Shared\Infrastructure\Factory`
   - `Presentation/Controllers/` - HTTP controllers
   - `Presentation/Requests/` - form request validators

2. **Domain Registration**: Create `<Domain>Domain.php` that extends `Heart\Core\Contracts\DomainInterface` and registers providers:
   ```php
   final class MyDomain extends DomainInterface
   {
       public function registerProvider(): array
       {
           return [
               MyServiceProvider::class,
               MyRouteProvider::class,
           ];
       }
   }
   ```

3. **Service Provider**: Bind repository interfaces to implementations in `Infrastructure\Providers\<Domain>ServiceProvider`

4. **Route Provider**: Register routes in `Infrastructure\Providers\<Domain>RouteProvider` using `/api` prefix with `'bot-auth'` middleware

5. **Tests**: Create feature tests in `tests/Feature/<Domain>/` using `$this->actingAsAdmin()` for authenticated requests

6. **Entities**: Use named constructors like `::make()` and implement `JsonSerializable` for API responses

7. **Caching**: For read-heavy operations, add caching in Application layer using `Cache::remember()` with `TTL` helpers
