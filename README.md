# Cloudflare domain manager

## Deployment
```bash
./vendor/bin/sail up -d
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
