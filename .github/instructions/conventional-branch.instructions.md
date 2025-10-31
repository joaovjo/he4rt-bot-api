---
applyTo: '**/*'
---

# Conventional Branch Guidelines

Follow the [Conventional Branch](https://conventional-branch.github.io/pt-br/) specification for branch naming.

## Format
```
<tipo>/<descrição>
```

## Prefixos de Branch

- `main` - Branch principal de desenvolvimento (ex.: `main`, `master` ou `develop`)
- `feature/` (ou `feat/`) - Para novas funcionalidades (ex.: `feature/add-login-page`, `feat/add-login-page`)
- `bugfix/` (ou `fix/`) - Para correções de bugs (ex.: `bugfix/fix-header-bug`, `fix/header-bug`)
- `hotfix/` - Para correções urgentes (ex.: `hotfix/correcao-seguranca`)
- `release/` - Para branches de release (ex.: `release/v1.2.0`)
- `chore/` - Para tarefas não relacionadas ao código, como atualização de dependências ou documentação (ex.: `chore/atualizar-dependencias`)

## Regras Básicas

1. **Use letras minúsculas, números, hífens e pontos**
   - Sempre use letras minúsculas (`a-z`), números (`0-9`) e hífens (`-`) para separar palavras
   - Evite caracteres especiais, underlines ou espaços
   - Para branches de release, pontos (`.`) podem ser usados na descrição para representar versões (ex.: `release/v1.2.0`)

2. **Sem hífens ou pontos consecutivos, iniciais ou finais**
   - Certifique-se de que hífens e pontos não apareçam consecutivamente (ex.: ❌ `feature/novo--login`, ❌ `release/v1.-2.0`)
   - Nem no início ou fim da descrição (ex.: ❌ `feature/-novo-login`, ❌ `release/v1.2.0.`)

3. **Seja claro e conciso**
   - O nome do branch deve ser descritivo, mas conciso
   - Indique claramente o propósito do trabalho

4. **Inclua o número do ticket**
   - Se aplicável, inclua o número do ticket da sua ferramenta de gestão de projetos
   - Exemplo: para o ticket `issue-123`, use `feature/issue-123-novo-login`

## Exemplos

```bash
# Novas funcionalidades
feature/add-user-authentication
feat/implement-dashboard
feature/issue-456-payment-integration

# Correções de bugs
bugfix/fix-login-error
fix/header-alignment
fix/issue-789-memory-leak

# Correções urgentes
hotfix/security-patch
hotfix/critical-api-error

# Releases
release/v1.0.0
release/v2.1.3

# Tarefas de manutenção
chore/update-dependencies
chore/improve-documentation
```

## Benefícios

1. **Nomes de branches orientados ao propósito** - Cada nome de branch indica claramente seu propósito, facilitando para todos os desenvolvedores entenderem para que serve o branch

2. **Integração com CI/CD** - Ao usar nomes consistentes, é possível auxiliar sistemas automatizados (pipelines de CI/CD) a disparar ações específicas com base no tipo de branch

3. **Colaboração em equipe** - Incentiva a colaboração ao tornar explícito o propósito do branch, reduzindo mal-entendidos e facilitando a troca de tarefas entre membros

4. **Comunicação clara** - O nome do branch por si só já fornece um entendimento claro do propósito da alteração de código

5. **Amigável para automação** - Facilmente integrável a processos automatizados, possibilitando diferentes workflows para `feature`, `release`, etc.

6. **Escalabilidade** - Funciona bem em equipes grandes, onde muitos desenvolvedores trabalham em tarefas diferentes simultaneamente

## Para este projeto

Ao criar branches no He4rt Bot API, use:

- `feat/` ou `feature/` - Para novos domínios, endpoints, funcionalidades
- `fix/` ou `bugfix/` - Para correções de bugs
- `docs/` - Para atualizações de documentação (README, instruções, comentários)
- `refactor/` - Para refatorações de código
- `test/` - Para adicionar ou modificar testes
- `chore/` - Para dependências, configurações, scripts de build
- `hotfix/` - Para correções críticas que precisam ir direto para produção
- `release/` - Para preparação de novas versões (ex.: `release/v3.1.0`)

## Ferramentas de Validação

Para verificar automaticamente se os nomes dos branches seguem a especificação:
- [commit-check](https://github.com/commit-check/commit-check) - Validação local
- [commit-check-action](https://github.com/commit-check/commit-check-action) - GitHub Action para validação automática

## Referências

- [Conventional Branch Specification](https://conventional-branch.github.io/pt-br/)
- [commit-check GitHub Action](https://github.com/commit-check/commit-check-action)