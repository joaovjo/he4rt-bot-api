---
applyTo: '**/*'
---

# Commit Message Guidelines

Follow the [Conventional Commits](https://www.conventionalcommits.org/pt-br/v1.0.0/) specification for all commit messages.

## Format
```
<tipo>[escopo opcional]: <descrição>

[corpo opcional]

[rodapé(s) opcional(is)]
```

## Estrutura do Commit

O commit contém os seguintes elementos estruturais:

1. **fix:** um commit do tipo `fix` soluciona um problema na sua base de código (correlaciona-se com PATCH do versionamento semântico)
2. **feat:** um commit do tipo `feat` inclui um novo recurso na sua base de código (correlaciona-se com MINOR do versionamento semântico)
3. **BREAKING CHANGE:** um commit que contém no rodapé o texto `BREAKING CHANGE:`, ou contém o símbolo `!` depois do tipo/escopo, introduz uma modificação que quebra a compatibilidade da API (correlaciona-se com MAJOR do versionamento semântico)

## Tipos de Commit

Tipos obrigatórios pela especificação:
- `feat` - Novo recurso (MINOR do versionamento semântico)
- `fix` - Correção de bug (PATCH do versionamento semântico)

Tipos adicionais recomendados (baseados na [Convenção do Angular](https://github.com/angular/angular/blob/22b96b9/CONTRIBUTING.md#-commit-message-guidelines)):
- `build` - Modificações em arquivos de build e dependências
- `chore` - Atualizações de tarefas de build, configurações de administrador, pacotes
- `ci` - Mudanças relacionadas a integração contínua
- `docs` - Mudanças na documentação
- `style` - Formatações de código, semicolons, trailing spaces, lint
- `refactor` - Refatorações que não alterem funcionalidade
- `perf` - Alterações de código relacionadas a performance
- `test` - Alterações em testes

Tipos extras da comunidade:
- `raw` - Mudanças em arquivos de configurações, dados, features, parâmetros
- `cleanup` - Remover código comentado, trechos desnecessários, limpeza do código-fonte
- `remove` - Exclusão de arquivos, diretórios ou funcionalidades obsoletas
- `revert` - Reverter commits anteriores

## Emojis (opcional)

| Tipo de commit | Emoji | Palavra-chave |
|----------------|-------|---------------|
| Commit inicial | 🎉 `:tada:` | `init` |
| Novo recurso | ✨ `:sparkles:` | `feat` |
| Bugfix | 🐛 `:bug:` | `fix` |
| Documentação | 📚 `:books:` | `docs` |
| Testes | 🧪 `:test_tube:` | `test` |
| Aprovação de teste | ✔️ `:heavy_check_mark:` | `test` |
| Performance | ⚡ `:zap:` | `perf` |
| Refatoração | ♻️ `:recycle:` | `refactor` |
| Limpeza de código | 🧹 `:broom:` | `cleanup` |
| Removendo arquivo | 🗑️ `:wastebasket:` | `remove` |
| Infraestrutura | 🧱 `:bricks:` | `ci` |
| Configuração | 🔧 `:wrench:` | `chore` |
| Package.json | 📦 `:package:` | `build` |
| Estilização | 💄 `:lipstick:` | `feat` |
| Dados | 🗃️ `:card_file_box:` | `raw` |

## Escopo (opcional)

Um escopo PODE ser fornecido após o tipo para fornecer informações contextuais adicionais:
```
feat(parser): adiciona capacidade de interpretar arrays
fix(api): corrige validação de email
docs(readme): atualiza instruções de instalação
```

## Breaking Changes

Indique breaking changes de duas formas:

1. **Com `!` no prefixo:**
```
feat!: envia email para o cliente quando o produto é enviado
feat(api)!: envia email para o cliente quando o produto é enviado
```

2. **Com rodapé BREAKING CHANGE:**
```
feat: permitir que o objeto de configuração fornecido estenda outras configurações

BREAKING CHANGE: a chave `extends`, no arquivo de configuração, agora é utilizada
para estender outro arquivo de configuração
```

## Exemplos Completos

### Commit simples
```bash
docs: ortografia correta de CHANGELOG
```

### Commit com escopo
```bash
feat(lang): adiciona tradução para português brasileiro
```

### Commit com corpo e rodapé
```bash
fix: corrige pequenos erros de digitação no código

veja o ticket para detalhes sobre os erros de digitação corrigidos

Revisado por: Daniel Nass
Refs #133
```

### Commit de reversão
```bash
revert: nunca mais falaremos do incidente do miojo

Refs: 676104e, a215868
```

### Exemplos com emojis (opcional)
```bash
🎉 init: Commit inicial
📚 docs: Atualização do README
🐛 fix: Loop infinito na linha 50
✨ feat: Página de login
🧱 ci: Modificação no Dockerfile
♻️ refactor: Passando para arrow functions
⚡ perf: Melhoria no tempo de resposta
🧪 test: Criando novo teste
🧹 cleanup: Removendo código comentado
🗑️ remove: Removendo arquivos não utilizados
```

## Especificação (Regras)

1. A mensagem DEVE ser prefixada com um tipo (`feat`, `fix`, etc.) seguido por escopo OPCIONAL, símbolo `!` OPCIONAL, e OBRIGATÓRIO terminar com dois-pontos e espaço
2. O tipo `feat` DEVE ser usado quando adiciona novo recurso
3. O tipo `fix` DEVE ser usado quando corrige um problema
4. Um escopo PODE ser fornecido após o tipo entre parênteses: `feat(parser):`
5. Uma descrição DEVE existir após o prefixo tipo/escopo
6. Um corpo PODE ser fornecido após a descrição, começando após linha em branco
7. Um ou mais rodapés PODEM ser fornecidos após uma linha em branco do corpo
8. Rodapés DEVEM usar o formato `<token>: <valor>` ou `<token> #<valor>`
9. Token de rodapé DEVE usar `-` no lugar de espaços: `Acked-by` (exceto `BREAKING CHANGE`)
10. `BREAKING CHANGE` DEVE ser indicada no tipo/escopo com `!` ou como rodapé
11. Tipos diferentes de `feat` e `fix` PODEM ser usados
12. Unidades de informação NÃO DEVEM ser case-sensitive, exceto `BREAKING CHANGE` que DEVE ser maiúscula
13. `BREAKING-CHANGE` DEVE ser sinônimo de `BREAKING CHANGE` em rodapés

## Recomendações

- Adicione um tipo consistente com o conteúdo do commit
- Mantenha a primeira linha concisa (máximo 4 palavras recomendado)
- Para descrições detalhadas, use o corpo do commit
- Use emoji no início da mensagem (opcional mas recomendado)
- Evite encurtadores de link e links afiliados
- Volte e faça vários commits quando um commit se enquadrar em múltiplos tipos

## Corpo e Rodapé

- **Corpo**: Descrições precisas apresentando impactos e motivos das alterações. O corpo DEVE começar após uma linha em branco após a descrição e é livre para conter múltiplos parágrafos
  - Exemplo: `veja o ticket para detalhes sobre os erros de digitação corrigidos`
  
- **Rodapé**: Informação sobre revisor, número do card (Trello/Jira), ou SHAs de commits relacionados. Rodapés seguem a convenção do [git trailer format](https://git-scm.com/docs/git-interpret-trailers)
  - Exemplo: `Reviewed-by: Daniel Nass`
  - Exemplo: `Refs #133`
  - Exemplo: `Refs: 676104e, a215868`

## Benefícios

- Criação automatizada de CHANGELOGs
- Determinação automática de alterações no versionamento semântico (baseado nos tipos)
- Comunicação clara da natureza das mudanças para equipe e stakeholders
- Facilita contribuições através de histórico estruturado
- Integração com ferramentas de CI/CD e automação

## Relação com SemVer

- Commits `fix` → releases `PATCH` (0.0.X)
- Commits `feat` → releases `MINOR` (0.X.0)
- Commits com `BREAKING CHANGE` → releases `MAJOR` (X.0.0)

## Para este projeto

Ao commitar no He4rt Bot API, prefira:
- `feat:` para novos domínios, endpoints ou funcionalidades
- `fix:` para correções de bugs
- `refactor:` ao reorganizar código mantendo comportamento
- `docs:` para README, instruções, comentários
- `test:` ao adicionar ou modificar testes
- `chore:` para dependências, configurações, scripts de build
- `perf:` para otimizações de performance
- `ci:` para mudanças em workflows de CI/CD

## Referências

- [Conventional Commits Specification](https://www.conventionalcommits.org/pt-br/v1.0.0/)
- [Padrões de Commits - @iuricode](https://github.com/iuricode/padroes-de-commits)
- [Angular Commit Guidelines](https://github.com/angular/angular/blob/22b96b9/CONTRIBUTING.md#-commit-message-guidelines)
