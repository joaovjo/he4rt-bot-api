---
tags: [domain, authentication]
aliases: [OAuth, Auth]
related:
  - "[[architecture]]"
---

# Authentication/OAuth

> [!info] Metadata
> Type: Domain
> Location: `Heart/Authentication/OAuth`
> Status: Active

## Overview
Authentication and OAuth domain.

## File Structure
```
Authentication/OAuth/
├── Application/
│   └── OAuthService.php
├── Domain/
│   ├── DTO/
│   │   ├── OAuthUserDTO.php
│   │   └── OAuthAccessDTO.php
│   └── Interfaces/
│       └── OAuthClientContract.php
├── Infrastructure/
│   ├── Enums/
│   │   └── OAuthProviderEnum.php
│   └── Providers/
│       ├── AuthenticationServiceProvider.php
│       └── AuthenticationRouteProvider.php
└── Presentation/
  └── Controllers/
    └── OAuthController.php
```

## Architectural Organization
- Application: OAuth service
- Domain: contracts and DTOs
- Infrastructure: enums, service provider and route mapping
- Presentation: HTTP controller

## Relationships
Depends on: [[domains/user]]
Used by: [[apis/endpoints]]

## Tags
#domain #authentication
