# =============================================================================
# mvc-schedule — Makefile
# Запускать из корня проекта. Для Docker-команд нужен запущенный Docker.
# =============================================================================

COMPOSE = docker compose
COMPOSE_DEV = docker compose -f docker-compose.yml -f docker-compose.dev.yml
SERVICE = app

# -----------------------------------------------------------------------------
# Docker: запуск и остановка
# -----------------------------------------------------------------------------

# up — поднять все сервисы (app, MySQL, phpMyAdmin, Redis, phpRedisAdmin).
# Когда: деплой без монтирования кода; код берётся из образа.
up:
	$(COMPOSE) up -d

# up-dev — то же, но с монтированием кода (режим разработки).
# Когда: локальная разработка; изменения в файлах сразу видны в контейнере.
up-dev:
	$(COMPOSE_DEV) up -d

# down — остановить и удалить контейнеры (данные в volumes сохраняются).
# Когда: закончили работу или перед перезапуском с другими опциями.
down:
	$(COMPOSE) down

# build — пересобрать Docker-образ приложения.
# Когда: изменили Dockerfile или нужно обновить образ после правок зависимостей.
build:
	$(COMPOSE) build

# -----------------------------------------------------------------------------
# Docker: выполнение команд в контейнере
# -----------------------------------------------------------------------------

# exec — выполнить произвольную команду в контейнере app (без dev-файла).
# Когда: контейнеры подняты через make up.
# Пример: make exec CMD="php bootstrap/migrations.php"
exec:
	$(COMPOSE) exec $(SERVICE) $(CMD)

# exec-dev — то же, но для контейнеров, поднятых через make up-dev.
# Когда: контейнеры подняты через make up-dev.
# Пример: make exec-dev CMD="php bootstrap/seed.php"
exec-dev:
	$(COMPOSE_DEV) exec $(SERVICE) $(CMD)

# shell — открыть интерактивный bash в контейнере app.
# Когда: нужно вручную что-то выполнить или посмотреть файлы внутри контейнера.
shell:
	$(COMPOSE) exec $(SERVICE) /bin/bash

# shell-dev — то же для dev-режима (если поднято через up-dev).
shell-dev:
	$(COMPOSE_DEV) exec $(SERVICE) /bin/bash

# -----------------------------------------------------------------------------
# Миграции и сидеры (контейнеры подняты через make up)
# -----------------------------------------------------------------------------

# migrate — применить все неприменённые миграции.
# Когда: после pull/merge с новыми миграциями или первая настройка БД.
migrate:
	$(COMPOSE) exec $(SERVICE) php bootstrap/migrations.php

# migrate-status — показать, какие миграции применены, какие ожидают.
# Когда: проверить состояние миграций перед/после деплоя.
migrate-status:
	$(COMPOSE) exec $(SERVICE) php bootstrap/migration_status.php

# migrate-rollback — откатить последнюю миграцию.
# Когда: нужно отменить последний batch миграций.
migrate-rollback:
	$(COMPOSE) exec $(SERVICE) php bootstrap/migrate_rollback.php

# migrate-fresh — пересоздать БД (drop all + миграции заново).
# Когда: чистый старт или отладка; данные БД будут потеряны.
migrate-fresh:
	$(COMPOSE) exec $(SERVICE) php bootstrap/migration_fresh.php

# seed — выполнить сидеры (наполнение тестовыми/начальными данными).
# Когда: после миграций на новой БД или для восстановления справочников.
seed:
	$(COMPOSE) exec $(SERVICE) php bootstrap/seed.php

# fix-migrations — утилита для исправления состояния таблицы миграций.
# Когда: миграции «сломались» или нужно починить запись в migrations.
fix-migrations:
	$(COMPOSE) exec $(SERVICE) php bootstrap/fix_migrations.php

# create-migration — создать новый файл миграции.
# Когда: добавляете новую таблицу или изменение схемы.
# Пример: make create-migration NAME=create_orders_table
create-migration:
	$(COMPOSE) exec $(SERVICE) php bootstrap/create_migration.php $(NAME)

# -----------------------------------------------------------------------------
# Миграции и сидеры в dev-режиме (контейнеры подняты через make up-dev)
# -----------------------------------------------------------------------------

# migrate-dev — применить миграции в dev-контейнере.
migrate-dev:
	$(COMPOSE_DEV) exec $(SERVICE) php bootstrap/migrations.php

# migrate-status-dev — статус миграций в dev.
migrate-status-dev:
	$(COMPOSE_DEV) exec $(SERVICE) php bootstrap/migration_status.php

# seed-dev — выполнить сидеры в dev.
seed-dev:
	$(COMPOSE_DEV) exec $(SERVICE) php bootstrap/seed.php

# -----------------------------------------------------------------------------
# Фронтенд (webpack)
# -----------------------------------------------------------------------------

# frontend-build — одна сборка фронтенда (JS/CSS в public/assets).
# Когда: перед коммитом или деплоем; результат — production-сборка.
frontend-build:
	cd frontend && npm run build

# frontend-watch — сборка в режиме watch (пересборка при изменении файлов).
# Когда: разработка стилей/скриптов; оставить запущенным в отдельном терминале.
frontend-watch:
	cd frontend && npm run dev

.PHONY: up up-dev down build exec exec-dev shell shell-dev migrate migrate-dev migrate-status migrate-rollback migrate-fresh seed fix-migrations create-migration migrate-status-dev seed-dev frontend-build frontend-watch
