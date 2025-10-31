<div align="center">

<img src="./.github/logo.png" height="220" alt="He4rt Developers Logo">

# He4rt Discord Bot API

**API REST para integração com o bot Discord da He4rt Developers**

[![Commit Check](https://github.com/he4rt/he4rt-bot-api/actions/workflows/commit-check.yml/badge.svg)](https://github.com/he4rt/he4rt-bot-api/actions/workflows/commit-check.yml)
[![Pre-commit](https://github.com/he4rt/he4rt-bot-api/actions/workflows/pre-commit.yml/badge.svg)](https://github.com/he4rt/he4rt-bot-api/actions/workflows/pre-commit.yml)
[![License](https://img.shields.io/github/license/he4rt/he4rt-bot-api?color=A655FF)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)

[![Discord](https://img.shields.io/badge/Discord-He4rt_Developers-5865F2?logo=discord&logoColor=white)](https://discord.gg/he4rt)
[![Conventional Commits](https://img.shields.io/badge/Conventional%20Commits-1.0.0-FE5196?logo=conventionalcommits&logoColor=white)](https://conventionalcommits.org)
[![Conventional Branch](https://img.shields.io/badge/Conventional%20Branch-1.0.0-blue)](https://conventional-branch.github.io)

</div>

## 📋 Sobre o Projeto

API REST desenvolvida em Laravel 12 com arquitetura DDD (Domain-Driven Design) para gerenciar funcionalidades do bot Discord da comunidade He4rt Developers. A aplicação oferece endpoints para gamificação, ranking, badges, eventos e integração com Discord.

## ✨ Features

- 🎮 **Sistema de Gamificação** - Badges, conquistas e pontuação
- 📊 **Ranking** - Sistema de ranking sazonal por atividades
- 👤 **Gestão de Usuários** - Perfis, endereços e informações complementares
- 📅 **Eventos** - Gestão de reuniões e participantes
- 💬 **Mensagens** - Integração com provedores de mensagens (Discord)
- 🔐 **Autenticação** - Middleware customizado via header `X-He4rt-Authorization`

## 🛠️ Tecnologias

- **PHP 8.3** - Linguagem de programação
- **Laravel 12** - Framework web
- **PostgreSQL 18** - Banco de dados relacional
- **Redis 8** - Cache e filas
- **Docker** - Containerização
- **Pest** - Framework de testes
- **Pint** - Code formatter
- **Rector** - Automated refactoring
- **PHPStan** - Static analysis

## 📦 Estrutura do Projeto

```
Heart/                      # Domínios DDD
├── Character/              # Personagens/perfis
├── Meeting/                # Eventos e reuniões
├── Provider/               # Provedores (Discord)
├── Ranking/                # Sistema de ranking
├── Season/                 # Temporadas/seasons
├── User/                   # Usuários
└── Shared/                 # Utilitários compartilhados
    ├── Application/        # Casos de uso
    ├── Domain/             # Entidades e contratos
    ├── Infrastructure/     # Repositórios e persistência
    └── Presentation/       # Controllers e rotas

app-modules/                # Módulos da API
├── badge/                  # Sistema de badges
└── message/                # Sistema de mensagens
```

## 🚀 Requisitos

- [Docker](https://docs.docker.com/get-docker/) e Docker Compose
- [Make](https://www.gnu.org/software/make/) (opcional, mas recomendado)
- [Composer](https://getcomposer.org/) 2.x
- [Node.js](https://nodejs.org/) 20.x ou superior
- [Python](https://python.org/) 3.x (para pre-commit hooks)

## ⚙️ Configuração

### 1. Clone o repositório

```bash
git clone https://github.com/he4rt/he4rt-bot-api.git
cd he4rt-bot-api
```

### 2. Configure o ambiente

```bash
# Copie o arquivo de ambiente
cp .env.example .env

# Configure as variáveis necessárias no .env
# HE4RT_BOT_SECRET - Secret para autenticação
# DISCORD_* - Credenciais Discord
```

### 3. Instale as dependências e configure o projeto

```bash
# Usando Make (recomendado)
make setup

# Ou manualmente
composer install
npm install
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan ide-helper:generate
```

### 4. Suba os containers

```bash
make env-up

# Ou
docker-compose up -d
```

## 🏃 Desenvolvimento

### Iniciar ambiente de desenvolvimento

```bash
# Inicia servidor, queue listener, log tail e Vite
make dev

# Ou
composer run dev
```

Isso iniciará:
- HTTP server em `http://localhost:8000`
- Queue listener para jobs assíncronos
- Laravel Pail para logs em tempo real
- Vite dev server para assets

### Executar testes

```bash
# Todos os testes
make test

# Apenas testes unitários
make test-unit

# Apenas testes de feature
make test-feature

# Com filtro específico
make test filter=CharacterTest
```

### Quality Gates

```bash
# Verificar qualidade do código
make check

# Formatar código automaticamente
make format
```

## 📝 Padrões de Desenvolvimento

Este projeto segue convenções rigorosas para commits e branches:

### Conventional Commits

Formato: `<tipo>[escopo opcional]: <descrição>`

Tipos permitidos:
- `feat` - Nova funcionalidade
- `fix` - Correção de bug
- `docs` - Documentação
- `style` - Formatação
- `refactor` - Refatoração
- `perf` - Performance
- `test` - Testes
- `build` - Build/dependências
- `ci` - CI/CD
- `chore` - Manutenção

Exemplos:
```bash
git commit -m "feat(character): adiciona endpoint de criação de personagem"
git commit -m "fix(auth): corrige validação de token"
git commit -m "docs: atualiza README com instruções de setup"
```

### Conventional Branch

Formato: `<tipo>/<descrição>`

Exemplos:
```bash
git checkout -b feat/user-profile-endpoint
git checkout -b fix/ranking-calculation
git checkout -b docs/api-documentation
```

### Pre-commit Hooks

Para ativar validação local antes de commits:

```bash
# Instalar pre-commit
pip install pre-commit

# Ativar hooks
pre-commit install --hook-type pre-commit --hook-type commit-msg
```

Os hooks validarão automaticamente:
- ✅ Mensagens de commit seguem Conventional Commits
- ✅ Nomes de branches seguem Conventional Branch

## 🔐 Autenticação

Todas as requisições devem incluir o header de autenticação:

```bash
X-He4rt-Authorization: seu_token_aqui
```

Configure `HE4RT_BOT_SECRET` no `.env` para o token correto.

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch seguindo Conventional Branch (`git checkout -b feat/nova-feature`)
3. Commit suas mudanças seguindo Conventional Commits (`git commit -m 'feat: adiciona nova feature'`)
4. Push para a branch (`git push origin feat/nova-feature`)
5. Abra um Pull Request

Consulte [CONTRIBUTING.md](CONTRIBUTING.md) para mais detalhes (se disponível).

## 📄 Licença

Este projeto está sob a licença especificada no arquivo [LICENSE](LICENSE).

## 🔗 Links

- [Documentação da API](https://api.heartdevs.com/docs) _(em breve)_
- [Discord He4rt Developers](https://discord.gg/he4rt)
- [Conventional Commits](https://www.conventionalcommits.org/pt-br/)
- [Conventional Branch](https://conventional-branch.github.io/pt-br/)

---

<div align="center">

**Desenvolvido com 💜 pela [He4rt Developers](https://github.com/he4rt)**

</div>
