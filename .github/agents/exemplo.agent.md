---
description: 'Describe what this custom agent does and when to use it.'
tools: []
argument-hint: 'Provide hints about the arguments that can be passed to the function or method in question.'
name: 'Exemplo-de-Agente'
handoffs: 
  - label: Start Implementation
    agent: agent
    prompt: Implement the plan
    send: true
model: Auto (copilot)
target: vscode
---
Define what this custom agent accomplishes for the user, when to use it, and the edges it won't cross. Specify its ideal inputs/outputs, the tools it may call, and how it reports progress or asks for help.