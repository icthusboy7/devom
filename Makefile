#.PHONY: help

help:           ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

CONTAINER_PHP=devom-php

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

# 👌 Main targets

build: start deps migration ## Build docker container, composer install and up containers
build-prod: composer-install-prod start-prod ## Build docker container for production
build-test: deps start-test ## Build docker container for testing

deps: composer-install

# 🐘 Composer

composer-install: CMD=install
composer-update: CMD=update

# Usage example (add a new dependency): `make composer CMD="require --dev symfony/var-dumper ^4.2"`
composer composer-install composer-update:
	@docker exec -it $(CONTAINER_PHP) composer $(CMD)


composer-install-prod:
	composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
				
#composer global require hirak/prestissimo \
#gsingh1/prestissimo $(CMD) \

# 🕵️ Clear cache
# OpCache: Restarts the unique process running in the PHP FPM container
# Nginx: Reloads the server

reload:
	@docker-compose exec php-fpm kill -USR2 1
	@docker-compose exec nginx nginx -s reload

# ✅ Tests

coverage:
	mkdir -p var/test_results/phpunit/coverage
	./vendor/bin/phpunit --coverage-html var/test_results/phpunit/coverage


# 🐳 Docker Compose
start: ## up docker containers
	#@docker-compose -f local/docker-compose.yaml up -d --no-recreate
	@docker-compose -f local/docker-compose.yaml up -d

start-prod: ENV=prod
start-test: ENV=test
start-prod start-test: ## up docker containers
	@docker-compose -f local/docker-compose.$(ENV).yaml up -d

start-ci:
	docker-compose build --build-arg SSH_PRIVATE_KEY="$(cat ~/.ssh/amelendres)"
	docker-composer up

stop: CMD=stop

down: CMD=down

# Usage: `make doco CMD="ps --services"`
# Usage: `make doco CMD="build --parallel --pull --force-rm --no-cache"`
doco stop down:
	@docker-compose -f local/docker-compose.yaml $(CMD)

rebuild:
	docker-compose -f local/docker-compose.yaml build --pull --force-rm --no-cache
	make deps
	make start

build-update:
	docker-compose -f local/docker-compose.yaml build --no-cache
	make deps
	make start

restart: ## restart your containers
	make stop
	@docker-compose -f local/docker-compose.yaml up --build -d

make sh:
	@docker exec -it $(CONTAINER_PHP) sh

# 🗄️ Data Base (AVOID in production)
migration:
	@docker exec -it $(CONTAINER_PHP) bin/console d:m:m --no-interaction
	
fixtures:		
	bin/console d:f:l -n
		
# 📝 Api commands
api-doc: ## generate or update swagger API Doc
	@docker exec -it $(CONTAINER_PHP) vendor/zircote/swagger-php/bin/openapi src/Appto -o public/api_v1.json


