# Запуск проекта в Docker

## Сервисы

| Сервис        | Порт  | Описание        |
|---------------|-------|-----------------|
| Приложение    | 8080  | http://localhost:8080 |
| phpMyAdmin    | 8081  | http://localhost:8081 |
| phpRedisAdmin | 8082  | http://localhost:8082 |
| MySQL         | 3306  | хост (для CLI)  |
| Redis         | 6379  | хост (для CLI)  |

Учётные данные MySQL соответствуют `config/config.php`: пользователь `root`, пароль пустой, БД `mvc-schedule`.

## Обычный запуск

```bash
docker compose up -d
# или: make up
```

Приложение: http://localhost:8080

**Важно:** при `make up` код в контейнер не монтируется — используется копия из образа. Если вы на хосте делаете `make frontend-build`, новые JS/CSS попадают только в папку на хосте; контейнер продолжает отдавать старые файлы из образа. Для разработки и проверки сборки фронта используйте режим dev (см. ниже).

## Режим разработки (dev)

Код монтируется в контейнер — изменения на хосте сразу видны в контейнере.

```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml up -d
```

Или через Makefile:

```bash
make up-dev
```

При первом запуске в контейнере выполнится `composer install`, если нет `vendor/autoload.php`.

## Команды внутри контейнера (Makefile)

Выполнить произвольную команду в контейнере `app`:

```bash
make exec CMD="php bootstrap/migrations.php"
make exec CMD="php bootstrap/seed.php"
make exec CMD="php bootstrap/migration_status.php"
```

В режиме dev используйте те же команды с `-f docker-compose.dev.yml` или алиасы:

```bash
make exec-dev CMD="php bootstrap/migrations.php"
make migrate-dev
make seed-dev
make migrate-status-dev
```

Другие цели:

- `make shell` / `make shell-dev` — интерактивный bash в контейнере
- `make migrate` — миграции
- `make migrate-status` — статус миграций
- `make migrate-rollback` — откат
- `make migrate-fresh` — пересоздание БД и миграции
- `make seed` — сидеры
- `make create-migration NAME=create_foo_table` — создать миграцию

## Без Makefile

```bash
# Запуск в dev
docker compose -f docker-compose.yml -f docker-compose.dev.yml up -d

# Выполнить скрипт из bootstrap
docker compose exec app php bootstrap/migrations.php
# или с dev-файлом:
docker compose -f docker-compose.yml -f docker-compose.dev.yml exec app php bootstrap/migrations.php

# Shell
docker compose exec app /bin/bash
```

## Остановка

```bash
docker compose down
# или с dev-файлом:
docker compose -f docker-compose.yml -f docker-compose.dev.yml down
```
