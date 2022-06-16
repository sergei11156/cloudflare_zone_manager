# Cloudflare domain manager

## Deployment
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

## API

Добавление аккаунта:
```
POST /api/accounts
Request Example:
{
    "name": "Name",
    "api_key": "999ApiKey999"
}
```
Получение всех аккаунтов:
```
GET /api/accounts
```
Запуск синхронизации аккаунтов с Cloudflare, отдаёт все домены:
```
GET /api/sync
```

Получение сохранённых доменов:
```
GET /api/domains
```

Синхронизация с Cloudflare запускается автоматически раз в день
