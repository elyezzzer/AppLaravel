# InventoryPlus

## Descrição

InventoryPlus é uma aplicação web construída com Laravel 12, organizada em arquitetura MVC e preparada para gerenciamento de inventário, geração de relatórios em PDF e suporte a upload/edição de imagens. O projeto utiliza recursos modernos de frontend com Tailwind CSS, Alpine.js e Vite, além de oferecer localizações em português brasileiro.

## Tecnologias principais

- PHP 8.2
- Composer (gerenciamento de dependências PHP)
- Node.js + npm (assets, Vite)
- Vite (bundler para assets JS/CSS)
- SQLite
- Artisan (CLI do Laravel)

## Bibliotecas principais

- Laravel 12 (framework PHP)
- Tailwind CSS + @tailwindcss/forms (estilização CSS)
- Alpine.js (framework JavaScript reativo)
- Cropper.js (edição de imagens)
- barryvdh/laravel-dompdf (geração de PDF)
- laravel/breeze (autenticação e scaffolding leve)


## Setup do projeto

### Clonar repositório

```bash
git clone https://github.com/elyezzzer/AppLaravel.git
```

### Entrar na pasta do projeto

```bash
cd AppLaravel
```

### Instalar dependências PHP

```bash
composer install --ignore-platform-reqs
```

### Copiar arquivo de ambiente

```bash
cp .env.example .env
```

### Criar chave de aplicação

```bash
php artisan key:generate
```

### Criar link de armazenamento

```bash
php artisan storage:link
```

### Instalar dependências JS

No CMD/PowerShell (se necessário em modo administrador)

```bash
npm install
```

### Compilar para desenvolvimento

```bash
npm run dev
```

### Compilar automaticamente enquanto edita

```bash
npm run watch
```

### Rodar migrations

```bash
php artisan migrate
```

### Rodar aplicação

```bash
php artisan serve
```