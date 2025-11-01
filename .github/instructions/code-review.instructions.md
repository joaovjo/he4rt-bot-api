---
applyTo: '**/*'
---

# Code Review Guidelines

Este documento estabelece as diretrizes de code review para o He4rt Bot API, baseado nas melhores práticas do Google Engineering e GitHub.

## Propósito do Code Review

O objetivo principal do code review é **melhorar continuamente a saúde do código** do projeto. Todas as ferramentas e processos de revisão são projetados para esse fim, equilibrando:

- **Progresso do desenvolvedor**: Permitir que mudanças sejam integradas sem burocracia excessiva
- **Qualidade do código**: Garantir que cada mudança melhore (ou no mínimo não piore) a saúde geral do código
- **Aprendizado**: Compartilhar conhecimento sobre linguagem, framework e princípios de design

## Padrão de Code Review

### Regra Principal

> **Em geral, revisores devem aprovar um PR assim que ele estiver em um estado onde definitivamente melhora a saúde geral do código do sistema, mesmo que o PR não seja perfeito.**

Não existe código "perfeito" - apenas código melhor. Busque **melhoria contínua**, não perfeição.

### Quando Aprovar

✅ **Aprovar quando:**
- O código melhora a manutenibilidade, legibilidade e compreensibilidade do sistema
- Testes adequados foram adicionados
- Segue os padrões do projeto (Pint, PHPStan, Rector)
- A funcionalidade está correta
- O design é apropriado

❌ **Rejeitar quando:**
- A mudança piora a saúde geral do código
- A funcionalidade não deveria existir no sistema
- Faltam testes críticos
- Problemas de segurança ou performance graves
- Não segue arquitetura DDD estabelecida

### Comentários Educacionais

Use prefixo **"Nit:"** para sugestões que são pontos de polimento, mas não obrigatórias:

```
Nit: Considere extrair esse método para melhorar legibilidade
```

## O Que Buscar em um Code Review

### 1. Design e Arquitetura

- ✅ As interações entre os componentes fazem sentido?
- ✅ A mudança pertence ao domínio correto (Character, User, Ranking, etc.)?
- ✅ Integra bem com o resto do sistema?
- ✅ Segue os princípios DDD (Application/Domain/Infrastructure/Presentation)?
- ✅ É o momento certo para adicionar essa funcionalidade?

**Pontos de atenção:**
- Evite over-engineering (código mais genérico do que necessário)
- Não aceite funcionalidades especulativas que "podem ser necessárias no futuro"
- Resolva o problema atual, não problemas hipotéticos

### 2. Funcionalidade

- ✅ O código faz o que o desenvolvedor pretendia?
- ✅ A intenção é boa para os usuários finais e futuros desenvolvedores?
- ✅ Casos extremos (edge cases) foram considerados?
- ✅ Problemas de concorrência foram evitados?
- ✅ Validações estão corretas?

**Quando testar:**
- Mudanças com impacto em UI/UX
- Endpoints críticos da API
- Lógica complexa de negócio

### 3. Complexidade

- ✅ O código pode ser entendido rapidamente por outros desenvolvedores?
- ✅ Linhas individuais são claras?
- ✅ Funções e métodos não são muito complexos?
- ✅ Classes mantêm responsabilidades únicas (SRP)?

**Sinais de complexidade excessiva:**
- Código que você não consegue entender rapidamente
- Desenvolvedores provavelmente introduzirão bugs ao modificar
- Lógica profundamente aninhada
- Métodos com muitos parâmetros

### 4. Testes

- ✅ Testes unitários foram adicionados para novas funcionalidades?
- ✅ Testes de feature cobrem os casos de uso principais?
- ✅ Testes realmente falham quando o código quebra?
- ✅ Testes não produzem falsos positivos?
- ✅ Assertions são simples e úteis?

**Lembre-se:** Testes também são código que precisa ser mantido. Não aceite complexidade desnecessária em testes.

**Para o He4rt Bot API:**
- Use `make test` para todos os testes
- Use `make test-unit` para testes unitários
- Use `make test-feature` para testes de feature
- Grupo de testes com `@group unit` ou `@group feature`

### 5. Nomenclatura

- ✅ Nomes comunicam claramente o propósito?
- ✅ Não são muito curtos nem muito longos?
- ✅ Seguem convenções do Laravel/PHP?
- ✅ Variáveis booleanas usam prefixos apropriados (`is`, `has`, `should`)?

**Exemplos:**
```php
// ❌ Ruim
$d = new CharacterRepository();
public function get($id) { }

// ✅ Bom
$characterRepository = new CharacterRepository();
public function findCharacterById(string $id): ?Character { }
```

### 6. Comentários

- ✅ Comentários explicam **por que**, não **o que**
- ✅ São necessários e úteis?
- ✅ Código está claro o suficiente para dispensar comentários?
- ✅ TODOs foram removidos quando aplicável?

**Bons usos de comentários:**
- Justificar decisões de design não óbvias
- Explicar regex complexas ou algoritmos
- Avisos sobre limitações conhecidas
- Links para issues/tickets relacionados

**Maus usos:**
- Explicar código que deveria ser auto-explicativo
- Código comentado (remova!)
- Comentários desatualizados

### 7. Estilo e Formatação

- ✅ Segue os padrões do Pint?
- ✅ Passa no PHPStan sem erros?
- ✅ Rector não sugere refatorações automáticas?

**Importante:**
- Use `make format` antes de commitar
- Use `make check` para validar localmente
- Não bloqueie PRs por preferências pessoais de estilo
- Grandes mudanças de formatação devem ser PRs separados

### 8. Documentação

- ✅ README foi atualizado se necessário?
- ✅ Docblocks PHPDoc estão corretos?
- ✅ Instruções de uso foram documentadas?
- ✅ Breaking changes foram documentados?

**Para o He4rt Bot API:**
- Atualizar README.md para novas features
- Docblocks em classes/métodos públicos
- Comentários em arquivos de configuração
- Instruções em `.github/instructions/` quando aplicável

### 9. Consistência

- ✅ Código novo segue padrões do código existente?
- ✅ Mantém consistência com a arquitetura DDD?
- ✅ Usa os mesmos padrões de injeção de dependência?

**Hierarquia de prioridade:**
1. Style guide (Pint/PSR-12)
2. Padrões do projeto (DDD, convenções estabelecidas)
3. Código existente na área modificada

### 10. Contexto do Sistema

- ✅ Melhora a saúde geral do código?
- ✅ Não adiciona complexidade desnecessária ao sistema?
- ✅ Não degrada testes existentes?
- ✅ Domínio está bem definido e isolado?

**Perspectiva macro:**
- Sistemas se tornam complexos através de muitas pequenas mudanças
- Prevenir pequenas complexidades em mudanças novas é crucial
- Considere impacto em outros domínios (Character, User, Ranking, etc.)

## Como Revisar

### 1. Revise Cada Linha

- Leia cada linha de código atribuída para você
- Não assuma que o código está correto sem ler
- Data files e código gerado podem ser escaneados rapidamente
- Se o código é difícil de entender, peça esclarecimentos

### 2. Veja o Arquivo Completo

- Ferramentas de review mostram apenas linhas modificadas
- Veja o arquivo completo para entender o contexto
- Verifique se a mudança faz sentido no contexto maior

### 3. Considere o Sistema Todo

- A mudança melhora ou piora o sistema como um todo?
- Adiciona débito técnico?
- Facilita ou dificulta manutenção futura?

### 4. Reconheça Coisas Boas

- Elogie código bem escrito
- Reconheça quando o desenvolvedor implementou sua sugestão bem
- Code reviews não são apenas para apontar erros
- Mentoria positiva é valiosa

## Velocidade de Review

### Tempo de Resposta

- **1 dia útil**: Tempo máximo para primeira resposta
- **Algumas horas**: Ideal para PRs pequenos e críticos
- **Imediatamente**: Se você não está no meio de uma tarefa focada

### Quando Aprovar Rapidamente

- ✅ PRs pequenos e bem escritos
- ✅ Mudanças urgentes (hotfixes)
- ✅ Correções de bugs simples
- ✅ Atualizações de documentação

### LGTM com Comentários

Se o PR está bom mas tem sugestões menores (Nits):
1. Aprove o PR
2. Deixe comentários como sugestões
3. Confie que o autor implementará

## Como Escrever Comentários

### Tom e Atitude

✅ **Bom:**
- "Considere extrair esse método para melhorar legibilidade"
- "Esse nome pode ser mais descritivo. Que tal `calculateSeasonalScore`?"
- "Ótima solução! Apenas uma sugestão de melhoria..."

❌ **Ruim:**
- "Isso está errado"
- "Por que você fez assim?"
- "Refatore isso"

### Estrutura do Comentário

1. **Seja específico**: Explique o problema e sugira solução
2. **Justifique**: Explique por que sua sugestão é melhor
3. **Use dados**: Referências a documentação, benchmarks, etc.
4. **Seja educado**: Critique o código, não o desenvolvedor

### Tipos de Comentários

**Obrigatório:**
```
Esta validação permite injeção SQL. Use prepared statements.
```

**Sugestão (Nit):**
```
Nit: Considere usar `collect()` ao invés de `array_map()` aqui para manter consistência com o Laravel
```

**Elogio:**
```
Excelente uso do pattern Strategy aqui! Facilita adicionar novos tipos de badges no futuro.
```

**Pergunta:**
```
Esse método precisa ser público? Parece ser usado apenas internamente.
```

## Lidando com Pushback

### Quando o Desenvolvedor Discorda

1. **Busque consenso**: Discuta baseado em princípios técnicos
2. **Reunião/videochamada**: Se comentários não resolvem
3. **Documente**: Registre a decisão no PR
4. **Escalação**: Tech Lead → Maintainer → Eng Manager

### Quando Você Está Errado

- Admita quando o desenvolvedor tem razão
- Aprenda com a discussão
- Atualize seu entendimento

### Quando Ambos Estão Certos

- Se várias abordagens são válidas, aceite a preferência do autor
- Se não há "certo" claro, mantenha consistência com código existente

## Checklist do Revisor

Antes de aprovar um PR, verifique:

- [ ] **Design**: A arquitetura faz sentido e segue DDD?
- [ ] **Funcionalidade**: O código faz o que deveria?
- [ ] **Complexidade**: Não é mais complexo do que precisa?
- [ ] **Testes**: Testes adequados foram adicionados?
- [ ] **Nomenclatura**: Nomes são claros e descritivos?
- [ ] **Comentários**: Comentários explicam o "por quê"?
- [ ] **Estilo**: Segue Pint, PHPStan, Rector?
- [ ] **Documentação**: README e docblocks atualizados?
- [ ] **Consistência**: Mantém padrões do projeto?
- [ ] **Contexto**: Melhora a saúde geral do código?

## Status de Review no GitHub

### Comment (Comentário)

Use para:
- Fazer perguntas
- Sugestões não obrigatórias
- Discussões sobre abordagem

### Approve (Aprovar)

Use quando:
- O PR melhora a saúde do código
- Todos os problemas críticos foram resolvidos
- Testes passam e cobrem adequadamente

### Request Changes (Solicitar Mudanças)

Use quando:
- Problemas críticos precisam ser resolvidos
- Faltam testes essenciais
- Código degrada a saúde do sistema
- Problemas de segurança ou performance graves

## Ferramentas para Revisão

### Local
```bash
# Verificar estilo e qualidade
make check

# Executar testes
make test

# Ver diff completo
git diff 3.x...feature-branch
```

### GitHub
- **Files changed**: Ver todas as mudanças
- **Conversations**: Acompanhar discussões
- **Checks**: CI/CD status (commit-check, pre-commit, tests)
- **Copilot**: Solicitar review automática com GitHub Copilot

### GitHub CLI
```bash
# Fazer checkout do PR localmente
gh pr checkout 123

# Adicionar comentário
gh pr comment 123 --body "Ótimo trabalho!"

# Aprovar
gh pr review 123 --approve

# Solicitar mudanças
gh pr review 123 --request-changes --body "Favor adicionar testes"
```

## Princípios Fundamentais

1. **Fatos técnicos sobrepõem opiniões**: Use dados, não preferências pessoais
2. **Style guide é autoridade absoluta**: Pint/PSR-12 é a referência
3. **Design é baseado em princípios**: SOLID, DDD, não em opinião
4. **Aceite escolha do autor**: Se várias abordagens são igualmente válidas
5. **Melhoria contínua**: Busque progresso, não perfeição

## Situações Especiais

### Emergências

Em casos de emergência (produção quebrada):
- Aceite mudanças que pioram temporariamente a saúde do código
- Exija issue de follow-up para corrigir adequadamente
- Documente a dívida técnica criada

### PRs Grandes

- Peça para dividir em PRs menores se possível
- Revise por partes (design → funcionalidade → testes → style)
- Comente explicitamente quais partes você revisou

### Revisão Parcial

Se você revisou apenas partes:
- Comente explicitamente o que revisou
- Use "LGTM with comments" se apropriado
- Certifique-se de que outros revisores cobrem o resto

## Recursos e Referências

- [Google Engineering Practices - Code Review](https://google.github.io/eng-practices/review/)
- [GitHub - About Pull Request Reviews](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/reviewing-changes-in-pull-requests/about-pull-request-reviews)
- [Conventional Commits](https://www.conventionalcommits.org/pt-br/)
- [Laravel Best Practices](https://github.com/alexeymezenin/laravel-best-practices)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [Domain-Driven Design](https://martinfowler.com/tags/domain%20driven%20design.html)

---

**Lembre-se**: Code review é uma ferramenta de colaboração, aprendizado e melhoria contínua. Seja construtivo, respeitoso e focado em melhorar o código e o time! 💜