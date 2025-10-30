# Message Domain Migration Analysis

## Current Structure Analysis

### Files to be Migrated from Heart/Message/

#### Application Layer
- `Heart/Message/Application/NewMessage.php` → `app-modules/message/src/Actions/NewMessage.php`
- `Heart/Message/Application/NewVoiceMessage.php` → `app-modules/message/src/Actions/NewVoiceMessage.php`

#### Domain Layer
- `Heart/Message/Domain/Actions/PersistMessage.php` → `app-modules/message/src/Actions/PersistMessage.php`
- `Heart/Message/Domain/DTO/NewMessageDTO.php` → `app-modules/message/src/DTOs/NewMessageDTO.php`
- `Heart/Message/Domain/DTO/NewVoiceMessageDTO.php` → `app-modules/message/src/DTOs/NewVoiceMessageDTO.php`
- `Heart/Message/Domain/Entities/MessageEntity.php` → `app-modules/message/src/Entities/MessageEntity.php`
- `Heart/Message/Domain/Entities/VoiceEntity.php` → `app-modules/message/src/Entities/VoiceEntity.php`
- `Heart/Message/Domain/Repositories/MessageRepository.php` → `app-modules/message/src/Repositories/MessageRepository.php`
- `Heart/Message/Domain/Repositories/VoiceRepository.php` → `app-modules/message/src/Repositories/VoiceRepository.php`

#### Infrastructure Layer
- `Heart/Message/Infrastructure/Models/Message.php` → `app-modules/message/src/Models/Message.php`
- `Heart/Message/Infrastructure/Models/Voice.php` → `app-modules/message/src/Models/Voice.php`
- `Heart/Message/Infrastructure/Repositories/MessageEloquentRepository.php` → `app-modules/message/src/Repositories/MessageEloquentRepository.php`
- `Heart/Message/Infrastructure/Repositories/VoiceEloquentRepository.php` → `app-modules/message/src/Repositories/VoiceEloquentRepository.php`
- `Heart/Message/Infrastructure/Factories/MessageFactory.php` → `app-modules/message/database/factories/MessageFactory.php`
- `Heart/Message/Infrastructure/Providers/MessageServiceProvider.php` → Merge into `app-modules/message/src/Providers/MessageServiceProvider.php`
- `Heart/Message/Infrastructure/Providers/MessageRouteProvider.php` → Merge into `app-modules/message/src/Providers/MessageServiceProvider.php`

#### Presentation Layer
- `Heart/Message/Presentation/Controllers/MessagesController.php` → `app-modules/message/src/Http/Controllers/MessagesController.php`
- `Heart/Message/Presentation/Request/CreateMessageRequest.php` → `app-modules/message/src/Http/Requests/CreateMessageRequest.php`
- `Heart/Message/Presentation/Request/CreateVoiceMessageRequest.php` → `app-modules/message/src/Http/Requests/CreateVoiceMessageRequest.php`

#### Domain Registration
- `Heart/Message/MessageDomain.php` → To be removed (replaced by service provider registration)

## External Dependencies and References

### Files that Import Heart\Message Classes

#### Test Files
1. **tests/Unit/Message/MessageProviderTrait.php**
   - Imports: `Heart\Message\Domain\Entities\MessageEntity`
   - Action: Update import to `He4rt\Message\Entities\MessageEntity`

2. **tests/Unit/Message/Application/NewMessageTest.php**
   - Imports: 
     - `Heart\Message\Application\NewMessage`
     - `Heart\Message\Domain\Actions\PersistMessage`
     - `Heart\Message\Domain\DTO\NewMessageDTO`
   - Action: Update all imports to new `He4rt\Message` namespace

3. **tests/Unit/Message/Domain/Actions/PersistMessageTest.php**
   - Imports:
     - `Heart\Message\Domain\Actions\PersistMessage`
     - `Heart\Message\Domain\DTO\NewMessageDTO`
     - `Heart\Message\Domain\Entities\MessageEntity`
     - `Heart\Message\Domain\Repositories\MessageRepository`
   - Action: Update all imports to new `He4rt\Message` namespace

4. **tests/Feature/User/FindProfileTest.php**
   - Imports: `Heart\Message\Infrastructure\Models\Message`
   - Action: Update import to `He4rt\Message\Models\Message`

5. **tests/Feature/User/UpdateProfileTest.php**
   - Imports: `Heart\Message\Infrastructure\Models\Message`
   - Action: Update import to `He4rt\Message\Models\Message`

#### External Domain Files
1. **Heart/Provider/Infrastructure/Models/Provider.php**
   - Imports: `Heart\Message\Infrastructure\Models\Message`
   - Action: Update import to `He4rt\Message\Models\Message`

### Internal Heart/Message Files (Self-References)
All files within the Heart/Message directory contain internal references that need namespace updates:

1. **Heart/Message/MessageDomain.php**
   - References: `Heart\Message\Infrastructure\Providers\MessageRouteProvider`, `Heart\Message\Infrastructure\Providers\MessageServiceProvider`

2. **Heart/Message/Infrastructure/Providers/MessageRouteProvider.php**
   - References: `Heart\Message\Presentation\Controllers\MessagesController`

3. **Heart/Message/Infrastructure/Models/Message.php**
   - References: `Heart\Message\Infrastructure\Factories\MessageFactory`

4. **Heart/Message/Infrastructure/Repositories/MessageEloquentRepository.php**
   - References: `Heart\Message\Domain\DTO\NewMessageDTO`, `Heart\Message\Domain\Entities\MessageEntity`, `Heart\Message\Domain\Repositories\MessageRepository`, `Heart\Message\Infrastructure\Models\Message`

5. **Heart/Message/Infrastructure/Repositories/VoiceEloquentRepository.php**
   - References: `Heart\Message\Domain\DTO\NewVoiceMessageDTO`, `Heart\Message\Domain\Entities\VoiceEntity`, `Heart\Message\Domain\Repositories\VoiceRepository`, `Heart\Message\Infrastructure\Models\Voice`

6. **Heart/Message/Infrastructure/Providers/MessageServiceProvider.php**
   - References: `Heart\Message\Domain\Repositories\MessageRepository`, `Heart\Message\Domain\Repositories\VoiceRepository`, `Heart\Message\Infrastructure\Repositories\MessageEloquentRepository`, `Heart\Message\Infrastructure\Repositories\VoiceEloquentRepository`

7. **Heart/Message/Infrastructure/Factories/MessageFactory.php**
   - References: `Heart\Message\Infrastructure\Models\Message`

8. **Heart/Message/Domain/Actions/PersistMessage.php**
   - References: `Heart\Message\Domain\DTO\NewMessageDTO`, `Heart\Message\Domain\Entities\MessageEntity`, `Heart\Message\Domain\Repositories\MessageRepository`

9. **Heart/Message/Presentation/Controllers/MessagesController.php**
   - References: `Heart\Message\Application\NewMessage`, `Heart\Message\Application\NewVoiceMessage`, `Heart\Message\Presentation\Request\CreateMessageRequest`, `Heart\Message\Presentation\Request\CreateVoiceMessageRequest`

10. **Heart/Message/Application/NewVoiceMessage.php**
    - References: `Heart\Message\Domain\DTO\NewVoiceMessageDTO`, `Heart\Message\Domain\Repositories\VoiceRepository`

11. **Heart/Message/Application/NewMessage.php**
    - References: `Heart\Message\Domain\Actions\PersistMessage`, `Heart\Message\Domain\DTO\NewMessageDTO`

12. **Heart/Message/Domain/Repositories/VoiceRepository.php**
    - References: `Heart\Message\Domain\DTO\NewVoiceMessageDTO`, `Heart\Message\Domain\Entities\VoiceEntity`

13. **Heart/Message/Domain/Repositories/MessageRepository.php**
    - References: `Heart\Message\Domain\DTO\NewMessageDTO`, `Heart\Message\Domain\Entities\MessageEntity`

## Configuration Changes Required

### 1. Domain Registration Removal
- Remove `Heart\Message\MessageDomain` from domain auto-discovery system
- The DomainManager automatically discovers domains by scanning for `*Domain.php` files in the Heart directory

### 2. Service Provider Registration
- The new module is already configured in `app-modules/message/composer.json` with:
  ```json
  "extra": {
    "laravel": {
      "providers": [
        "He4rt\\Message\\Providers\\MessageServiceProvider"
      ]
    }
  }
  ```

### 3. Composer Autoload
- Main `composer.json` already includes `"Heart\\": "Heart/"` for the old structure
- Module `composer.json` already includes `"He4rt\\Message\\": "src/"` for the new structure
- After migration, the Heart\Message namespace will no longer be needed

## Namespace Migration Map

| Current Namespace | Target Namespace |
|-------------------|------------------|
| `Heart\Message\Application\*` | `He4rt\Message\Actions\*` |
| `Heart\Message\Domain\Actions\*` | `He4rt\Message\Actions\*` |
| `Heart\Message\Domain\DTO\*` | `He4rt\Message\DTOs\*` |
| `Heart\Message\Domain\Entities\*` | `He4rt\Message\Entities\*` |
| `Heart\Message\Domain\Repositories\*` | `He4rt\Message\Repositories\*` |
| `Heart\Message\Infrastructure\Models\*` | `He4rt\Message\Models\*` |
| `Heart\Message\Infrastructure\Repositories\*` | `He4rt\Message\Repositories\*` |
| `Heart\Message\Infrastructure\Factories\*` | `He4rt\Message\Database\Factories\*` |
| `Heart\Message\Infrastructure\Providers\*` | `He4rt\Message\Providers\*` |
| `Heart\Message\Presentation\Controllers\*` | `He4rt\Message\Http\Controllers\*` |
| `Heart\Message\Presentation\Request\*` | `He4rt\Message\Http\Requests\*` |

## External Dependencies (Other Domains)

The Message domain depends on the following external domains:
- `Heart\Character` - For experience increment and character management
- `Heart\Meeting` - For meeting attendance tracking
- `Heart\Provider` - For provider management and account creation
- `Heart\User` - For user management

These dependencies will remain unchanged as they are not part of this migration.

## Database Considerations

### Existing Migrations
- All existing database migrations in `database/migrations/` will remain unchanged
- The Message and Voice models will maintain the same table names and relationships

### Model Relationships
- Provider model has relationship with Message model - this import needs updating
- All other model relationships are internal to the Message domain

## Test Migration Requirements

### Tests to Move
- `tests/Feature/Message/` → `app-modules/message/tests/Feature/`
- `tests/Unit/Message/` → `app-modules/message/tests/Unit/`

### Tests to Update (External)
- `tests/Feature/User/FindProfileTest.php` - Update Message model import
- `tests/Feature/User/UpdateProfileTest.php` - Update Message model import

## Route Configuration

Current routes are likely defined in the MessageRouteProvider. These need to be:
1. Extracted from the provider
2. Moved to `app-modules/message/routes/message-routes.php`
3. Registered in the consolidated service provider