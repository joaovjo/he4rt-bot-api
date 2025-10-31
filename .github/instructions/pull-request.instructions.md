---
applyTo: '**/*'
---

# Pull Request Guidelines

Siga estas diretrizes ao criar Pull Requests para o He4rt Bot API.

## Estrutura do Pull Request

Um Pull Request bem estruturado consiste em duas partes:
- **Título**: Resumo curto e informativo do pull request
- **Descrição**: Texto explicativo mais detalhado descrevendo o PR para o revisor

## Título do Pull Request

### Formato Recomendado

```
#[Issue_ID] <tipo>[escopo opcional]: <descrição>
```

**Exemplo:**
```
#123 feat(character): adiciona endpoint de criação de personagem
#456 fix(auth): corrige validação de token JWT
docs: atualiza README com instruções de setup
```

### Regras para o Título

1. **Seja conciso e descritivo** (máximo 50-72 caracteres)
   - ❌ Ruim: "fix bug"
   - ✅ Bom: "fix: resolve null pointer error in authentication module"

2. **Use modo imperativo** (combina com mensagens de commit)
   - ✅ "add: support CSV export for reports"
   - ✅ "fix: correct off-by-one error in pagination"

3. **Comece com letra maiúscula** na descrição
   - ✅ "#23 Add Edit on GitHub button"

4. **Não termine com ponto final**
   - ❌ "feat: adiciona novo endpoint."
   - ✅ "feat: adiciona novo endpoint"

5. **Inclua referência ao issue/ticket** quando aplicável
   - ✅ "feat: implement user profile view (closes #123)"
   - ✅ "#CLS-23 Add Edit on GitHub button"

6. **Siga convenção consistente** (Conventional Commits)
   - Use prefixos: `feat`, `fix`, `docs`, `refactor`, `test`, `chore`, `perf`, `ci`, `build`

### Tipos de Título

- `feat` - Nova funcionalidade
- `fix` - Correção de bug
- `docs` - Documentação
- `refactor` - Refatoração de código
- `test` - Adição ou modificação de testes
- `chore` - Tarefas de manutenção
- `perf` - Melhorias de performance
- `ci` - Mudanças em CI/CD
- `build` - Mudanças em build ou dependências

### Exemplos Comparativos

| ❌ Ruim | ✅ Bom |
|---------|-------|
| "bug fix" | "fix: correct off-by-one error in pagination logic" |
| "update code" | "refactor: extract authentication middleware for reusability" |
| "PR for new feature" | "feat: add search functionality to user dashboard (closes #456)" |
| "changes" | "#89 fix(ranking): corrige cálculo de pontos sazonal" |

## Descrição do Pull Request

### Estrutura

A descrição deve ser separada do título por uma linha em branco e conter:

1. **O que** foi mudado
2. **Por que** a mudança foi necessária
3. **Como** foi implementado
4. **Impactos** da mudança

### Formato Recomendado

```markdown
## Descrição

[Descrição clara e concisa do que foi implementado]

## Motivação

[Por que essa mudança foi necessária? Que problema resolve?]

## Mudanças Realizadas

- Mudança 1
- Mudança 2
- Mudança 3

## Testes

- [ ] Testes unitários adicionados/atualizados
- [ ] Testes de feature adicionados/atualizados
- [ ] Testado manualmente

## Checklist

- [ ] Código segue os padrões do projeto (Pint, PHPStan)
- [ ] Commits seguem Conventional Commits
- [ ] Branch segue Conventional Branch
- [ ] Documentação atualizada (se necessário)
- [ ] Sem breaking changes (ou documentado)

## Issues Relacionadas

Closes #123
Refs #456
```

### Regras para a Descrição

1. **Cada parágrafo deve ter no máximo 72 caracteres**
2. **Capitalize cada parágrafo**
3. **Seja claro e objetivo**
4. **Explique o contexto** para o revisor
5. **Liste mudanças específicas** quando necessário

### Exemplo Completo

**Título:**
```
#23 feat(badge): adiciona sistema de conquistas por temporada
```

**Descrição:**
```markdown
## Descrição

Este pull request adiciona o sistema de conquistas (badges) vinculado às
temporadas (seasons), permitindo que usuários ganhem badges específicos
baseados em suas atividades durante cada temporada.

## Motivação

O sistema de gamificação precisa de badges temporais para incentivar
participação contínua dos membros da comunidade He4rt. Badges por temporada
criam senso de urgência e exclusividade.

## Mudanças Realizadas

- Criado modelo `SeasonBadge` com relacionamento N:N entre Badge e Season
- Implementado endpoint `POST /api/seasons/{id}/badges` para vincular badges
- Adicionado endpoint `GET /api/users/{id}/badges/season/{seasonId}` 
- Criada migration para tabela `season_badges`
- Atualizado `CharacterRepository` para incluir badges sazonais
- Adicionados testes unitários para `SeasonBadgeService`

## Testes

- [x] Testes unitários adicionados
- [x] Testes de feature adicionados
- [x] Testado manualmente no ambiente local

## Checklist

- [x] Código segue os padrões do projeto
- [x] Commits seguem Conventional Commits
- [x] Branch segue Conventional Branch
- [x] Documentação atualizada
- [x] Sem breaking changes

## Issues Relacionadas

Closes #23
Refs #15
```

## Boas Práticas Adicionais

### Durante a Criação

1. **Mantenha o PR focado** - Um PR = Uma funcionalidade/correção
2. **Tamanho adequado** - Evite PRs com mais de 400 linhas mudadas
3. **Commits organizados** - Agrupe commits relacionados logicamente
4. **Auto-revisão** - Revise suas próprias mudanças antes de submeter
5. **Screenshots/GIFs** - Adicione para mudanças visuais

### Durante a Revisão

1. **Responda comentários** de forma construtiva
2. **Marque conversas como resolvidas** após implementar sugestões
3. **Force push com cuidado** - Use `--force-with-lease`
4. **Mantenha atualizado** - Faça rebase/merge da branch base regularmente

### Antes do Merge

1. **Todos os checks passando** - CI/CD, testes, linters
2. **Conflitos resolvidos** - Sem conflitos com branch base
3. **Aprovações necessárias** - Mínimo de aprovações atingido
4. **Descrição revisada** - Título e descrição ainda refletem as mudanças

## Links de Referência

- [Conventional Commits](https://www.conventionalcommits.org/pt-br/)
- [Conventional Branch](https://conventional-branch.github.io/pt-br/)
- [Best PR Title Guidelines - Graphite](https://graphite.dev/guides/best-pr-title-guidelines)
- [PR Naming Convention](https://namingconvention.org/git/pull-request-naming)
- [GitHub PR Best Practices](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/getting-started/helping-others-review-your-changes)

## Ferramentas Úteis

- **Graphite AI** - Geração automática de títulos e descrições de PR
- **GitHub CLI** - `gh pr create --title "..." --body "..."`
- **Pre-commit hooks** - Validação local antes do push