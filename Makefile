
build:
	docker compose build

up:
	docker compose up -d

rm:
	docker compose rm -f

stop:
	docker compose down --remove-orphans

ps:
	docker ps -f name=dima_

restart:
	$(MAKE) stop
	$(MAKE) rm
	$(MAKE) start

init:
	$(MAKE) build
	$(MAKE) start
	$(MAKE) ps

start:
	$(MAKE) up
	docker compose exec -T php bash -c "composer install"
	docker compose exec -T php bash -c "php bin/console cache:clear"
	docker compose exec -T php bash -c "php bin/console assets:install"