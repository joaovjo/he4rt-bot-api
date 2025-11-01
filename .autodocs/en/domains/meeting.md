---
tags: [domain]
aliases: [Meetings]
related:
  - "[[architecture]]"
---

# Meeting

> [!info] Metadata
> Type: Domain
> Location: `Heart/Meeting`
> Status: Active

## Overview
Meeting lifecycle: start, end, attendance and listing with pagination.

## File Structure
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

## Tags
#domain #meeting
