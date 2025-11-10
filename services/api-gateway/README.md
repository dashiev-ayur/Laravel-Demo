# API Gateway

API Gateway для микросервисной архитектуры на базе Laravel компонентов.

## Установка

1. Установите зависимости:
```bash
composer install
```

2. Скопируйте файл конфигурации:
```bash
cp .env.example .env
```

## Быстрый запуск

### 1. Установка зависимостей
```bash
composer install
```

### 2. Запуск сервера
```bash
php -S localhost:8000 -t public
```

### 3. Проверка работы
```bash
# Health check
curl http://localhost:8000/api/health

# Greeting
curl http://localhost:8000/api/greeting
```

## Запуск через Docker

Из корня проекта:
```bash
cd ../../infrastructure
docker-compose up -d
```

## API Endpoints

### GET /api/health
Проверка работоспособности сервиса.

**Пример ответа:**
```json
{
    "status": "ok"
}
```

### GET /api/greeting
Возвращает приветственное сообщение.

**Пример ответа:**
```json
{
    "message": "Привет! Добро пожаловать в API Gateway",
    "status": "success",
    "timestamp": "2024-01-01T12:00:00+00:00"
}
```

## Структура проекта

```
api-gateway/
├── app/
│   └── Http/
│       └── Controllers/
├── config/
├── public/
│   └── index.php
├── routes/
│   └── api.php
└── composer.json
```

