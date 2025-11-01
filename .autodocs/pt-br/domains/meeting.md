---
tags: [domain]
aliases: [Reuniões]
related:
  - "[[architecture]]"
---

# Meeting

> [!info] Metadados
> **Tipo**: Domain
> **Localização**: `Heart/Meeting`
> **Status**: Active

## Visão Geral
[Descrição do domínio Meeting.]

## Estrutura de Arquivos
```
Meeting/
├── Application/
│   ├── AttendMeeting.php
│   ├── EndMeeting.php
│   ├── PaginateMeetings.php
│   └── StartMeeting.php
├── Domain/
│   ├── Actions/
│   │   ├── CreateMeeting.php
│   │   ├── FindMeetingType.php
│   │   ├── FinishMeeting.php
│   │   ├── PaginateMeetings.php
│   │   └── PersistAttendMeeting.php
│   ├── DTO/
│   │   └── NewMeetingDTO.php
│   ├── Entities/
│   │   ├── MeetingEntity.php
│   │   └── MeetingTypeEntity.php
│   ├── Exceptions/
│   │   └── MeetingException.php
│   └── Repositories/
│       ├── MeetingRepository.php
│       └── MeetingTypeRepository.php
└── Infrastructure/
  ├── Exceptions/
  │   └── MeetingExceptions.php
  ├── Factories/
  │   ├── MeetingFactory.php
  │   └── MeetingTypeFactory.php
  ├── Models/
  │   ├── Meeting.php
  │   └── MeetingType.php
  ├── Providers/
  │   ├── MeetingRouteProvider.php
  │   └── MeetingServiceProvider.php
  └── Repositories/
    ├── MeetingEloquentRepository.php
    └── MeetingTypeEloquentRepository.php
```

## Organização Arquitetural
- Application: casos de uso para ciclo de vida de reuniões
- Domain: ações, entidades, DTO, repositórios e exceções
- Infrastructure: models, repositories, factories e providers
- Presentation: controllers e requests (ver arquivos em Presentation/)

## Principais Elementos
[Elementos]

## Tags
#domain #meeting