### Setup do projeto

## Clonar repositório

```bash
git clone https://github.com/elyezzzer/AppLaravel.git
```

## Entrar na pasta do projeto
```bash
cd /laravel
```

## Instalar dependências

```bash
composer install --ignore-platform-reqs
```

## Copiar dados da env

```bash
cp .env.example .env
```

## Criar uma chave de aplicação

```bash
php artisan key:generate
```

## Instalar dependencia JS
No CMD modo administrador
```bash
npm install
```
Compilar para desenvolvimento
```bash
npm run dev
```
Compilar automaticamente enquanto edita
```bash
npm run dev
```
Compilar para a produção
```bash
npm run dev
```

## Rodar migrations
```bash
php artisan migrate
```

## Rodar aplicação
```bash
php artisan serve
```