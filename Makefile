SHELL := /usr/bin/env bash
COMPOSER_HOME := $(HOME)/.config/composer
COMPOSER_CACHE_DIR := $(HOME)/.cache/composer

up:
	export UID && docker-compose up -d
	bin/wait_for_docker.bash "Generating autoload files"

down:
	docker-compose down -v

build:
	docker-compose build

bash:
	export UID && docker-compose run php bash

composer_bash: check_uid_and_env_vars
	export COMPOSER_HOME=$(COMPOSER_HOME) && export COMPOSER_CACHE_DIR=$(COMPOSER_CACHE_DIR) && export UID && docker-compose run  composer bash

tests:
	export UID && docker-compose run --rm php bash -c "vendor/bin/phpunit --coverage-clover tests/logs/clover.xml"
.PHONY: tests

phpcs:
	docker-compose run --rm php bash -c "vendor/bin/phpcs --ignore=vendor -n src"

phpcbf:
	docker-compose run --rm php bash -c "vendor/bin/phpcbf --ignore=vendor -n src"

securitychecker:
	docker-compose run --rm php bash -c "symfony local:check:security"

docker_clean:
	docker rm $(docker ps -a -q) || true
	docker rmi < echo $(docker images -q | tr "\n" " ")

check_uid_and_env_vars:
	if [ -z "$(UID)" ]; then echo "UID variable required, please run 'export UID' before running make task"; exit 1 ; fi
