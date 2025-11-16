```markdown
# AppLaravel

Descrição
---------
Aplicação web construída com Laravel (PHP) seguindo a arquitetura MVC.


Tecnologias principais
---------------------
- PHP (Laravel framework)
- Composer (gerenciamento de dependências PHP)
- Node.js + npm (assets, Vite)
- Vite (bundler para assets JS/CSS)
- SQLite
- Artisan (CLI do Laravel)

Setup do projeto
-----------------

## Clonar repositório

```bash
git clone https://github.com/elyezzzer/AppLaravel.git
```

## Entrar na pasta do projeto
```bash
cd /AppLaravel
```

## Instalar dependências (PHP)

```bash
composer install --ignore-platform-reqs
```

## Copiar arquivo de ambiente

```bash
cp .env.example .env
```

## Criar chave de aplicação

```bash
php artisan key:generate
```

## Instalar dependências JS
No CMD/PowerShell (se necessário em modo administrador)
```bash
npm install
```

Compilar para desenvolvimento
```bash
npm run dev
```

Compilar automaticamente enquanto edita
```bash
npm run watch
```

## Rodar migrations
```bash
php artisan migrate
```

## Rodar aplicação
```bash
php artisan serve
```