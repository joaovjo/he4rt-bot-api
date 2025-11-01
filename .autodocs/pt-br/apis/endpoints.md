---
tags: [api]
aliases: [Endpoints]
related:
  - "[[architecture]]"
---

# Endpoints da API

> [!info] Fonte
> Este documento agrega endpoints a partir dos arquivos de rotas do projeto.

## Laravel (routes/api.php)

> [!note] Nenhum endpoint atual definido
> O arquivo `routes/api.php` não contém rotas ativas no momento.

## Laravel (routes/web.php)

- GET `/` → view `welcome`

## Broadcast Channels (routes/channels.php)

- channel `App.Models.User.{id}` → autorizado se `user.id === id`

## Legacy Lumen (routes/old-api.php)

Autenticação:
- GET `/auth/oauth/{provider}` → `AuthController@authenticate`
- GET `/auth/logout` → `AuthController@logout`

Users (com middleware `bot-auth`):
- GET `/users/` → `UsersController@getUsers`
- POST `/users/` → `UsersController@postUser` (`users.store`)
- GET `/users/{discordId}` → `UsersController@getUser` (`users.show`)
- PUT `/users/{discordId}` → `UsersController@putUser` (`users.update`)
- DELETE `/users/{discordId}` → `UsersController@deleteUser` (`users.destroy`)
- POST `/users/{discordId}/daily` → `UsersController@postDaily` (`users.dailyPoints`)
- POST `/users/{discordId}/message` → `MessagesController@postMessage` (`users.messages.store`)
- POST `/users/{discordId}/claim-badge` → `BadgesController@postClaimBadge` (`users.badges.claim`)
- GET `/users/{discordId}/voice` → `RewardController@claimVoiceXp` (`users.voice.claim`)

Events (com middleware `bot-auth`):
- POST `/events/badges/` → `BadgesController@postBadge` (`events.badges.store`)
- POST `/events/meeting/end` → `MeetingsController@postEndMeeting` (`events.meeting.postEndMeeting`)
- POST `/events/meeting/attend` → `MeetingsController@postAttendMeeting` (`events.meeting.postAttendMeeting`)
- PATCH `/events/meeting/{meetingId}/subject` → `MeetingsController@postMeetingSubject` (`events.meeting.postMeetingSubject`)

Bot (com middleware `bot-auth`):
- PUT `/bot/gambling/money` → `GamblingController@putMoney`

Ranking:
- GET `/ranking/general` → `RankingController@getGeneralLevelRanking`
- GET `/ranking/messages` → `RankingController@getGeneralMessageRanking`

Feedback:
- POST `/feedback/` → `FeedbackController@create` (`feedback.create`)
- POST `/feedback/review/{feedbackId}/approve` → `FeedbackReviewController@approve` (`feedback.review.approve`)
- POST `/feedback/review/{feedbackId}/decline` → `FeedbackReviewController@decline` (`feedback.review.decline`)

Badges (feature flag `features.gamification.badges`):
- GET `/badges/` → `BadgesController@getBadges`
- POST `/badges/` → `BadgesController@postBadge`
- GET `/badges/{badgeId}` → `BadgesController@getBadge`
- DELETE `/badges/{badgeId}` → `BadgesController@deleteBadge`

Seasons:
- GET `/seasons/` → `Gamification\SeasonsController@getSeasons`
- GET `/seasons/current` → `SeasonsController@getCurrentSeason` (`seasons.current`)
