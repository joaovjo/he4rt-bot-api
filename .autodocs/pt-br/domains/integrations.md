---
tags: [domain]
aliases: [Integrações]
related:
  - "[[architecture]]"
---

# Integrations

> [!info] Metadados
> **Tipo**: Domain
> **Localização**: `Heart/Integrations`
> **Status**: Active

## Visão Geral
[Descrição do domínio Integrations.]

## Estrutura de Arquivos
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

## Integrações
[Listar integrações externas.]

## Tags
#domain #integration