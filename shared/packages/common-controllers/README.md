# Common Controllers

Общий пакет базовых контроллеров для всех микросервисов.

## Установка

Пакет автоматически подключается через Composer в каждом микросервисе:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../../shared/packages/common-controllers"
        }
    ],
    "require": {
        "php-demo01/common-controllers": "*"
    }
}
```

После добавления в `composer.json` выполните:

```bash
composer update
```

## Использование

Базовый класс `Controller` предоставляет метод `jsonToResponse()` для создания JSON ответов с правильной кодировкой UTF-8.

### В контроллерах сервисов

Контроллеры в сервисах наследуются от `App\Http\Controllers\Controller`, который в свою очередь наследуется от `Shared\Controller`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MyController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return $this->jsonToResponse([
            'message' => 'Success',
            'data' => [...]
        ], 200);
    }
}
```

## Методы

### `jsonToResponse($data, int $status): JsonResponse`

Создает JsonResponse с правильной кодировкой UTF-8 и заголовками.

**Параметры:**
- `$data` (array|object) - Данные для JSON ответа
- `$status` (int) - HTTP статус код (обязательный)

**Возвращает:** `JsonResponse`

**Пример:**
```php
// Успешный ответ
return $this->jsonToResponse(['status' => 'ok'], 200);

// Ошибка клиента
return $this->jsonToResponse(['error' => 'Bad request'], 400);

// Ошибка сервера
return $this->jsonToResponse(['error' => 'Server error'], 500);
```

## Структура

```
common-controllers/
├── src/
│   └── Controller.php    # Базовый класс контроллера
├── composer.json
└── README.md
```

## Обновление пакета

### Изменение существующего кода

При изменении кода в существующих классах **ничего делать не нужно** - изменения применяются автоматически благодаря симлинкам.

### Добавление новых классов

При добавлении новых классов обновите автозагрузку:

```bash
cd services/api-gateway
composer dump-autoload

cd ../logging-service
composer dump-autoload
```

### Изменение зависимостей

При изменении `composer.json` пакета обновите пакет в сервисах:

```bash
cd services/api-gateway
composer update php-demo01/common-controllers

cd ../logging-service
composer update php-demo01/common-controllers
```

**Подробная документация по workflow:** [../../docs/shared-packages-workflow.md](../../docs/shared-packages-workflow.md)

