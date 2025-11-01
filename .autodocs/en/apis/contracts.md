---
tags: [api]
aliases: [Contracts]
related:
  - "[[apis/endpoints]]"
---

# API Contracts

> [!info] About
> This document consolidates contracts (request and response payloads, schemas, errors) when available from source code or adjacent docs.

## General Conventions
- Authentication and authorization vary per endpoint (see [[apis/endpoints]])
- HTTP status codes follow standard semantics
- Errors return structured messages when supported
- Listed types reflect validations in code FormRequests/DTOs

## Users

### GET /api/users/
- Returns standard pagination with a list of users

Response 200 (application/json):
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
- Returns a user by ID

Path params:
- id: string (uuid)

Response 200 (application/json):
```json
{
  "id": "0b7d1c9a-...",
  "name": "johndoe",
  "isDonator": false
}
```

Response 4xx (application/json):
```json
{ "error": "User ... could not be instantiated." }
```

### GET /api/users/profile/{value}
- Returns profile by username OR provider_id

Path params:
- value: string (username or provider_id)

Response 200 (application/json):
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
- Update user profile info

Path params:
- value: string (username or provider_id)

Request body (application/json):
```json
{
  "info": {
    "name": "John Doe",
    "nickname": "john",
    "linkedin_url": "https://linkedin.com/in/...",
    "github_url": "https://github.com/...",
    "birthdate": "1990-01-01",
    "about": "About me"
  }
}
```

Validations:
- info: array, required
- info.name: string, max:100
- info.nickname: string, max:100
- info.linkedin_url: string
- info.github_url: string
- info.birthdate: string
- info.about: string

Response 200 (application/json):
```json
{}
```

---

## Feedbacks

### POST /api/feedbacks
- Create a feedback

Request body (application/json):
```json
{
  "sender_id": "user-uuid",
  "target_id": "user-uuid",
  "type": "kudos|report|other",
  "message": "Feedback text (up to 4000)"
}
```

Validations:
- sender_id: required, different:target_id
- target_id: required, different:sender_id
- type: required, string
- message: required, string, max:4000

Response 201 (application/json):
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
Response 200 (application/json): FeedbackEntity
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
- Register feedback review (approve/decline)

Path params:
- feedbackId: string (uuid)
- action: approved|declined

Request body (application/json):
```json
{
  "staff_id": "admin-user-uuid",
  "reason": "optional (up to 1000)"
}
```

Validations:
- action: required, in:approved,declined (via path)
- staff_id: required
- reason: nullable, string, max:1000

Response 201 (application/json):
```json
{ "message": "Feedback received successfully!" }
```

---

## Meetings

### GET /api/events/{provider}/meeting/
- List meetings with pagination

Path params:
- provider: discord|twitch

Response 200 (application/json):
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
- Start a meeting

Path params:
- provider: discord|twitch

Request body (application/json):
```json
{
  "meeting_type_id": 1,
  "provider_id": "provider-account-id"
}
```

Validations:
- meeting_type_id: required, integer
- provider_id: required
- provider: required (injected from path)

Response 201 (application/json):
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
- End the current meeting

Response 204 (no content)

---

## Providers

### POST /api/providers/{provider}
- Link/create a provider account for a user

Path params:
- provider: discord|twitch

Request body (application/json):
```json
{
  "provider_id": "1234567890",
  "username": "john"
}
```

Validations:
- provider: required, in:discord,twitch (injected from path)
- provider_id: required
- username: required

Response 201 (application/json):
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

## Badges (Module)

### GET /api/badges/
Response 200 (application/json):
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

Validations:
- provider: required, in:discord,twitch
- name: required, string
- description: required, string
- image_url: required, url
- redeem_code: required, string
- active: required, boolean

Response 201 (application/json): BadgeEntity
```json
{
  "id": 1,
  "name": "Badge A",
  "description": "...",
  "image_url": "https://.../badge.png"
}
```

### DELETE /api/badges/{badgeId}
Response 204 (no content)

---

## Messages (Module)

### POST /api/messages/{provider}
- Record a chat message

Path params:
- provider: twitch|discord

Request body (application/json):
```json
{
  "provider_id": "provider-account-id",
  "provider_message_id": "msg-123",
  "channel_id": "channel-xyz",
  "content": "Hello world",
  "sent_at": "2024-01-01T12:00:00Z"
}
```

Validations:
- provider: required, in:twitch,discord (injected from path)
- provider_id: required
- provider_message_id: required
- channel_id: required
- content: required, string
- sent_at: required

Response 204 (no content)

### POST /api/voices/{provider}
- Record a voice event

Request body (application/json):
```json
{
  "provider_id": "provider-account-id",
  "state": "muted|unmuted|disabled",
  "channel_name": "General"
}
```

Validations:
- provider: required, in:twitch,discord (injected from path)
- provider_id: required
- state: required, in:muted,unmuted,disabled
- channel_name: required, string

Response 204 (no content)

---

## OAuth Authentication

### GET /auth/oauth/{provider}/redirect
- Redirects to OAuth provider (302)

### GET /auth/oauth/{provider}
- Provider callback; authenticates and redirects to `/profile` (302)
