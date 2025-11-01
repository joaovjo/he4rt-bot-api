---
tags: [domain]
aliases: [Integrations]
related:
  - "[[architecture]]"
---

# Integrations

> [!info] Metadata
> Type: Domain
> Location: `Heart/Integrations`
> Status: Active

## Overview
Integrations domain, with Twitch clients for OAuth and Subscriber checks.

## File Structure
```
Integrations/
└── Twitch/
  ├── Common/
  │   ├── TwitchBaseClient.php
  │   ├── TwitchIntegrationProvider.php
  │   └── TwitchService.php
  ├── OAuth/
  │   ├── Domain/
  │   │   ├── DTO/
  │   │   │   ├── TwitchOAuthAccessDTO.php
  │   │   │   └── TwitchOAuthDTO.php
  │   │   └── TwitchOAuthService.php
  │   └── Infrastructure/
  │       └── TwitchOAuthClient.php
  └── Subscriber/
    ├── Domain/
    │   ├── DTO/
    │   │   └── TwitchSubscriberDTO.php
    │   ├── Enum/
    │   │   └── SubscriptionTiersEnum.php
    │   └── TwitchSubscribersService.php
    └── Infrastructure/
      └── TwitchSubscribersClient.php
```

## Tags
#domain #integration
