---
tags: [domain]
aliases: [Feedbacks]
related:
  - "[[architecture]]"
---

# Feedback

> [!info] Metadata
> Type: Domain
> Location: `Heart/Feedback`
> Status: Active

## Overview
Feedback domain.

## File Structure
```
Feedback/
├── Application/
│   └── ReviewFeedback.php
├── Domain/
│   ├── Actions/
│   │   ├── CreateFeedback.php
│   │   ├── GetFeedbackById.php
│   │   └── PersistFeedbackReview.php
│   ├── DTOs/
│   │   ├── FeedbackReviewDTO.php
│   │   └── NewFeedbackDTO.php
│   ├── Entities/
│   │   └── FeedbackEntity.php
│   ├── Enums/
│   │   └── ReviewTypeEnum.php
│   └── Repositories/
│       └── FeedbackRepository.php
└── Infrastructure/
  ├── Exceptions/
  │   └── FeedbackException.php
  ├── Factories/
  │   └── FeedbackFactory.php
  ├── Models/
  │   ├── Feedback.php
  │   └── Review.php
  ├── Providers/
  │   ├── FeedbackRouteProvider.php
  │   └── FeedbackServiceProvider.php
  └── Repositories/
    └── FeedbackEloquentRepository.php
```

## Data Flows
```mermaid
graph LR
  User --> Feedback
```

## Tags
#domain #feedback
