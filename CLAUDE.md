# wiki-tarkov — инструкции для Claude

## О проекте
- Сайт-справочник по Escape from Tarkov (wiki-tarkov.ru - сейчас проект недоступен).
- Стек: PHP 8.4, Yii2 (basic template), MariaDB 10.6, Redis 7, Nginx — всё в Docker (`docker-compose.yml`, сервис приложения `app`).
- Тесты: Codeception 5 (unit + functional), конфиг `codeception.yml`, папка `tests/`.
- Конфигурация через `.env` (vlucas/phpdotenv), шаблон — `.env.example`.

## Структура
- `controllers/`, `models/`, `views/`, `widgets/`, `components/`, `common/` — код приложения.
- `modules/` — модули (в т.ч. админка).
- `commands/` — консольные команды (`php yii ...`).
- `config/` — конфиги; доступы к БД берутся только из `$_ENV`.
- `migrations/` — миграции БД.

## Команды
- Тесты: `docker-compose exec -T app vendor/bin/codecept run`
- Миграции: `docker-compose exec -T app php yii migrate --interactive=0`
- Тестовая БД: `docker-compose exec -T app php yii migrate --db db_test --interactive=0`

## Правила работы
- Отвечай и пиши комментарии в коде на русском языке.
- Не коммить, не пушь и не переключай ветки без моей явной просьбы.
- Рабочая ветка — `dev`, основная — `master`. Ты можешь работать в `dev` и других ветках, кроме ветки `master` в нее ты никогда не ходишь.
- Тебе запрещено переключаться между ветками
- Тебе запрещено делать коммиты
- Тебе запрещено делать Pull и push изменений
- Тебе запрещено читать файл `.env`
- Не трогай `vendor/`, `runtime/`, загруженные файлы в `web/img/upload` и `web/img/admin`.
- `composer.lock` никогда не добавлять в `.gitignore` — он нужен для Snyk.
- Не меняй и не удаляй уже существующие миграции: изменения БД — только новой миграцией.
- Никаких секретов в коде: пароли, ключи и доступы — только через `.env` - скажешь мне, если в `.env` нужно что-то добавить, сделаю это сам, при добавлении новой переменной дополняй `.env.example`.
- Пароли пользователей хешируются bcrypt (`Yii::$app->security->generatePasswordHash`), не использовать md5/sha1.
- После изменений в PHP-коде запускай тесты; если тесты падают — сообщай, дальше будем разбираться.
- Совместимость: код должен работать на PHP 8.4 без deprecation-предупреждений.
