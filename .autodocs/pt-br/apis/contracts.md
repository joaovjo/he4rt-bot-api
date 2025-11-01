---
tags: [api]
aliases: [Contracts]
related:
  - "[[apis/endpoints]]"
---

# Contratos de API

> [!info] Sobre
> Este documento consolida contratos (payloads de requisição e resposta, esquemas, erros) quando disponíveis no código-fonte ou documentação adjacente.

## Convenções Gerais
- Autenticação e autorização variam por endpoint (ver [[apis/endpoints]])
- Códigos de status seguem convenções HTTP
- Erros retornam mensagens estruturadas quando suportado
- Tipos listados refletem validações nas FormRequests/DTOs do código

## Usuários (User)

### GET /api/users/
- Retorna paginação padrão com lista de usuários

Resposta 200 (application/json):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": "0b7d1c9a-...",
      "username": "johndoe",
      "is_donator": false
    }
  ],
  "first_page_url": "https://.../api/users?page=1",
  "from": 1,
  "last_page": 10,
  "last_page_url": "https://.../api/users?page=10",
  "links": [],
  "next_page_url": null,
  "path": "https://.../api/users",
  "per_page": 15,
  "prev_page_url": null,
  "to": 15,
  "total": 150
}
```

### GET /api/users/{id}
- Retorna um usuário por ID

Path params:
- id: string (uuid)

Resposta 200 (application/json):
```json
{
  "id": "0b7d1c9a-...",
  "name": "johndoe",
  "isDonator": false
}
```

Resposta 4xx (application/json):
```json
{ "error": "User ... could not be instantiated." }
```

### GET /api/users/profile/{value}
- Retorna o perfil via username OU provider_id

Path params:
- value: string (username ou provider_id)

Resposta 200 (application/json):
```json
{
  "id": "0b7d1c9a-...",
  "username": "johndoe",
  "information": {
    "id": "...",
    "user_id": "...",
    "name": "John Doe",
    "nickname": "john",
    "linkedin_url": "https://linkedin.com/in/...",
    "github_url": "https://github.com/...",
    "birthdate": "1990-01-01",
    "about": "..."
  },
  "address": {
    "country": "BR",
    "state": "SP"
  },
  "character": {
    "id": "...",
    "user_id": "...",
    "reputation": 0,
    "experience": 1234,
    "level": 5,
    "ranking": 12
  },
  "connectedProviders": [
    {
      "id": "...",
      "user_id": "...",
      "provider": "twitch",
      "provider_id": "12345",
      "email": "example@...",
      "messages_count": 42
    }
  ],
  "badges": [
    { "id": 1, "name": "...", "description": "...", "image_url": "..." }
  ],
  "pastSeasons": [
    { "id": 1, "season_id": 2024, "points": 123 }
  ]
}
```

### PUT /api/users/profile/{value}
- Atualiza informações de perfil do usuário

Path params:
- value: string (username ou provider_id)

Request body (application/json):
```json
{
  "info": {
    "name": "John Doe",
    "nickname": "john",
    "linkedin_url": "https://linkedin.com/in/...",
    "github_url": "https://github.com/...",
    "birthdate": "1990-01-01",
    "about": "Sobre mim"
  }
}
```

Validações:
- info: array, required
- info.name: string, max:100
- info.nickname: string, max:100
- info.linkedin_url: string
- info.github_url: string
- info.birthdate: string
- info.about: string

Resposta 200 (application/json):
```json
{}
```

---

## Feedbacks (Feedback)

### POST /api/feedbacks
- Cria um feedback

Request body (application/json):
```json
{
  "sender_id": "user-uuid",
  "target_id": "user-uuid",
  "type": "kudos|report|other",
  "message": "Texto do feedback (até 4000)"
}
```

Validações:
- sender_id: required, different:target_id
- target_id: required, different:sender_id
- type: required, string
- message: required, string, max:4000

Resposta 201 (application/json):
```json
{
  "id": "...",
  "sender_id": "...",
  "target_id": "...",
  "type": "kudos",
  "message": "..."
}
```

### GET /api/feedbacks/{feedbackId}
Resposta 200 (application/json): FeedbackEntity
```json
{
  "id": "...",
  "sender_id": "...",
  "target_id": "...",
  "type": "kudos",
  "message": "..."
}
```

### POST /api/feedbacks/{feedbackId}/{action}
- Registra revisão de feedback (approve/decline)

Path params:
- feedbackId: string (uuid)
- action: approved|declined

Request body (application/json):
```json
{
  "staff_id": "admin-user-uuid",
  "reason": "opcional (até 1000)"
}
```

Validações:
- action: required, in:approved,declined (via path)
- staff_id: required
- reason: nullable, string, max:1000

Resposta 201 (application/json):
```json
{ "message": "Feedback recebido com sucesso!" }
```

---

## Eventos/Reuniões (Meeting)

### GET /api/events/{provider}/meeting/
- Lista reuniões com paginação

Path params:
- provider: discord|twitch

Resposta 200 (application/json):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": "...",
      "meeting_type_id": 1,
      "content": null,
      "admin_id": "...",
      "starts_at": "2024-01-01T12:00:00Z",
      "ends_at": null,
      "meeting_type": {
        "id": 1,
        "name": "Weekly",
        "week_day": 3,
        "start_at": "20:00"
      }
    }
  ],
  "per_page": 10,
  "total": 100
}
```

### POST /api/events/{provider}/meeting/start
- Inicia uma reunião

Path params:
- provider: discord|twitch

Request body (application/json):
```json
{
  "meeting_type_id": 1,
  "provider_id": "provider-account-id"
}
```

Validações:
- meeting_type_id: required, integer
- provider_id: required
- provider: required (injetado do path)

Resposta 201 (application/json):
```json
{
  "id": "...",
  "content": null,
  "meetingTypeId": 1,
  "adminId": "...",
  "startsAt": "2024-01-01T12:00:00Z",
  "endsAt": null,
  "createdAt": "2024-01-01T12:00:00Z",
  "updatedAt": "2024-01-01T12:00:00Z"
}
```

### POST /api/events/{provider}/meeting/end
- Encerra a reunião atual

Resposta 204 (no content)

---

## Provedores (Provider)

### POST /api/providers/{provider}
- Vincula/cria conta de provedor para usuário

Path params:
- provider: discord|twitch

Request body (application/json):
```json
{
  "provider_id": "1234567890",
  "username": "john"
}
```

Validações:
- provider: required, in:discord,twitch (injetado do path)
- provider_id: required
- username: required

Resposta 201 (application/json):
```json
{
  "id": "...",
  "userId": "...",
  "provider": {
    "provider": "twitch",
    "providerId": "1234567890"
  }
}
```

---

## Badges (Módulo)

### GET /api/badges/
Resposta 200 (application/json):
```json
[
  {
    "id": 1,
    "name": "Badge A",
    "description": "...",
    "image_url": "https://.../badge.png"
  }
]
```

### POST /api/badges/
Request body (application/json):
```json
{
  "provider": "discord|twitch",
  "name": "Badge A",
  "description": "...",
  "image_url": "https://.../badge.png",
  "redeem_code": "ABC123",
  "active": true
}
```

Validações:
- provider: required, in:discord,twitch
- name: required, string
- description: required, string
- image_url: required, url
- redeem_code: required, string
- active: required, boolean

Resposta 201 (application/json): BadgeEntity
```json
{
  "id": 1,
  "name": "Badge A",
  "description": "...",
  "image_url": "https://.../badge.png"
}
```

### DELETE /api/badges/{badgeId}
Resposta 204 (no content)

---

## Mensagens (Módulo)

### POST /api/messages/{provider}
- Registra mensagem de chat

Path params:
- provider: twitch|discord

Request body (application/json):
```json
{
  "provider_id": "provider-account-id",
  "provider_message_id": "msg-123",
  "channel_id": "channel-xyz",
  "content": "Olá mundo",
  "sent_at": "2024-01-01T12:00:00Z"
}
```

Validações:
- provider: required, in:twitch,discord (injetado do path)
- provider_id: required
- provider_message_id: required
- channel_id: required
- content: required, string
- sent_at: required

Resposta 204 (no content)

### POST /api/voices/{provider}
- Registra evento de voz

Request body (application/json):
```json
{
  "provider_id": "provider-account-id",
  "state": "muted|unmuted|disabled",
  "channel_name": "General"
}
```

Validações:
- provider: required, in:twitch,discord (injetado do path)
- provider_id: required
- state: required, in:muted,unmuted,disabled
- channel_name: required, string

Resposta 204 (no content)

---

## Autenticação OAuth

### GET /auth/oauth/{provider}/redirect
- Redireciona para provedor OAuth (302)

### GET /auth/oauth/{provider}
- Callback do provedor; autentica e redireciona para `/profile` (302)
