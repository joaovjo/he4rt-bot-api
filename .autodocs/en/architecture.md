---
tags: [architecture, overview]
aliases: [Architecture]
related:
  - "[[README]]"
  - "[[apis/endpoints]]"
---

# System Architecture

> [!info] Macro View
> High-level view of the main domains and modules. Links lead to specific documents.

```mermaid
graph LR
  subgraph Domains
    auth[Authentication/OAuth]
    character[Character]
    core[Core]
    feedback[Feedback]
    integrations[Integrations]
    meeting[Meeting]
    provider[Provider]
    ranking[Ranking]
    season[Season]
    shared[Shared]
    user[User]
  end

  subgraph Modules
    badge[badge]
    message[message]
  end

  subgraph APIs
    endpoints[API Endpoints]
  end

  endpoints --> user
  endpoints --> ranking
  endpoints --> feedback
  badge -. integrates .-> user
  message -. integrates .-> user
```

## Layers / Organization

- Domains in [[domains/core]] and other [[domains/*]] pages
- Modules in [[modules/badge]] and [[modules/message]]
- APIs documented in [[apis/endpoints]]

> [!note] Note
> Detailed relationships between components are reflected in the `metadata.json` graph and can be enriched as the documentation evolves.
