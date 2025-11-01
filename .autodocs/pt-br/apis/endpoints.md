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

## Módulos (routes)

Badge (app-modules/badge/routes/badge-routes.php):
- GET `/api/badges/` → `He4rt\Badge\Http\Controllers\BadgesController@getBadges` (`badges.index`)
- POST `/api/badges/` → `He4rt\Badge\Http\Controllers\BadgesController@postBadge` (`badges.store`)
- DELETE `/api/badges/{badgeId}` → `He4rt\Badge\Http\Controllers\BadgesController@deleteBadge` (`badges.destroy`)

Message (app-modules/message/routes/message-routes.php):
- POST `/api/messages/{provider}` → `He4rt\Message\Http\Controllers\MessagesController@postMessage` (`messages.create`)
- POST `/api/voices/{provider}` → `He4rt\Message\Http\Controllers\MessagesController@postVoiceMessage` (`voices.create`)

## Domínios (Route Providers)

User (Heart/User/Infrastructure/Providers/UserRouteProvider.php):
- GET `/api/users/` → `Heart\User\Presentation\Controllers\UsersController@getUsers` (`get-users`)
- GET `/api/users/profile/{value}` → `UsersController@getProfile` (`users.profile`)
- PUT `/api/users/profile/{value}` → `UsersController@putProfile` (`users.profile.update`)
- GET `/api/users/{id}` → `UsersController@getUser` (`get-user`)

Season (Heart/Season/Infrastructure/Providers/SeasonRouteProvider.php):
- GET `/season/v2/seasons` → `Heart\Season\Presentation\Controllers\SeasonsController@getSeasons` (`get-seasons`)
- GET `/season/v2/seasons/current` → `SeasonsController@getCurrent` (`seasons.current`)

Ranking (Heart/Ranking/Infrastructure/Providers/RankingRouteProvider.php):
- GET `/api/ranking/leveling` → `Heart\Ranking\Domain\Actions\RankingByLevel@handle` (`ranking.leveling`)

Authentication/OAuth (Heart/Authentication/OAuth/Infrastructure/Providers/AuthenticationRouteProvider.php):
- GET `/auth/oauth/{provider}` → `Heart\Authentication\OAuth\Presentation\Controllers\OAuthController@getAuthenticate`
- GET `/auth/oauth/{provider}/redirect` → `OAuthController@getRedirect`

Feedback (Heart/Feedback/Infrastructure/Providers/FeedbackRouteProvider.php):
- GET `/api/feedbacks/{feedbackId}` → `Heart\Feedback\Presentation\Controllers\FeedbacksController@getFeedback` (`feedbacks.show`)
- POST `/api/feedbacks` → `FeedbacksController@postFeedback` (`feedbacks.create`)
- POST `/api/feedbacks/{feedbackId}/{action}` → `FeedbacksController@postReview` (`feedbacks.review`)

Meeting (Heart/Meeting/Infrastructure/Providers/MeetingRouteProvider.php):
- GET `/api/events/{provider}/meeting/` → `Heart\Meeting\Presentation\Controllers\MeetingController@getMeetings` (`events.meeting.getMeetings`)
- POST `/api/events/{provider}/meeting/start` → `MeetingController@postMeeting` (`events.meeting.postMeeting`)
- POST `/api/events/{provider}/meeting/end` → `MeetingController@postEndMeeting` (`events.meeting.postEndMeeting`)

Provider (Heart/Provider/Infrastructure/Providers/ProviderRouteProvider.php):
- POST `/api/providers/{provider}` → `Heart\Provider\Presentation\Controllers\ProvidersController@postProvider` (`providers.store`)
