# Logging Service

Микросервис для логирования сообщений в консоль.

## Быстрый запуск

### 1. Установка зависимостей
```bash
composer install
```

### 2. Запуск сервера
```bash
php -S localhost:8001 -t public
```

### 3. Проверка работы
```bash
curl -X POST http://localhost:8001/api/log \
  -H "Content-Type: application/json" \
  -d '{"message": "Test log message", "level": "info"}'
```

## API Endpoints

### POST /api/log
Логирует сообщение в консоль.

**Параметры запроса:**
- `message` (обязательный) - текст сообщения для логирования
- `level` (опциональный) - уровень логирования (info, warning, error, debug). По умолчанию: info

**Пример запроса:**
```bash
curl -X POST http://localhost:8001/api/log \
  -H "Content-Type: application/json" \
  -d '{"message": "User logged in", "level": "info"}'
```

**Пример ответа:**
```json
{
    "status": "success",
    "message": "Message logged successfully",
    "logged_message": "User logged in",
    "level": "info",
    "timestamp": "2024-11-10 15:30:45"
}
```

## Структура проекта

```
logging-service/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── Controller.php
│           └── LogController.php
├── public/
│   └── index.php
├── routes/
│   └── api.php
└── composer.json
```

