---
tags: [architecture, overview]
aliases: [Arquitetura]
related:
  - "[[README]]"
  - "[[apis/endpoints]]"
---

# Arquitetura Geral

> [!info] Visão Macro
> Esta visão fornece um panorama dos principais domínios e módulos do projeto. Links levam a documentos específicos.

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
  badge -. integra .-> user
  message -. integra .-> user
```

## Camadas / Organização

- Domínios em [[domains/core]] e demais páginas de [[domains/*]]
- Módulos em [[modules/badge]] e [[modules/message]]
- APIs documentadas em [[apis/endpoints]]

> [!note] Observação
> Relacionamentos detalhados entre componentes são refletidos no grafo `metadata.json` e podem ser enriquecidos conforme a documentação evolui.
