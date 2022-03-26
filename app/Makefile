DOCKER_COMPOSE = docker-compose
EXEC_PHP       = $(DOCKER_COMPOSE) exec -T php
SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC_PHP) composer

##
## Проект
## ------

install: start db ## Установить и запустить проект

start: ## Запустить проект
	$(DOCKER_COMPOSE) up -d

build: ## Запустить проект
	$(DOCKER_COMPOSE) up -d --build

stop: ## Остановить проект
	$(DOCKER_COMPOSE) stop

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

clean: kill ## Остановить проект и удалить все сгенерированные артефакты Docker, Composer и Symfony
	rm -rf var vendor

reinstall: clean install ## Переустановить проект с нуля

nd: ## Запустить команду без Docker, например `make nd psalm`
	$(eval DOCKER_COMPOSE := \#)
	$(eval EXEC_PHP := )

vendor: composer.json composer.lock
	$(COMPOSER) install

.PHONY: install start stop kill clean reinstall nd

##
## Домены
## ------

install-certs-mac: ## Установить сертификат SSL на Mac
	sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain ./docker/proxy/certs/happy-job.wip.crt

add-hosts: ## Добавить домены в /etc/hosts
	bin/add_hosts

##
## Утилиты
## -------

db: vendor ## Создать базу данных и обновить схему
	@$(EXEC_PHP) php -r 'echo "Waiting for the database connection...\n"; set_time_limit(30); require __DIR__."/config/bootstrap.php"; $$url = parse_url($$_ENV["DATABASE_URL"]); while(true) { if(@fsockopen($$url["host"].":".($$url["port"] ?? 3306))) { break; }}'
	$(SYMFONY) doctrine:database:create --if-not-exists
	$(SYMFONY) doctrine:schema:update --force

.PHONY: db

##
## Контроль качества кода
## ----------------------

check: phpunit psalm php-cs-fixer phpmd dephpend lint-yaml composer-validate composer-require-checker ## Запустить все проверки качества кода

phpunit: ## Запустить тесты PHPUnit (https://phpunit.de/)
	$(EXEC_PHP) phpunit

lint-yaml: ## Проверить YAML-файлы при помощи Symfony YAML linter (https://symfony.com/doc/current/components/yaml.html#syntax-validation)
	$(SYMFONY) lint:yaml config --parse-tags

php-cs-fixer: ## Проверить PHP code style при помощи PHP CS Fixer (https://github.com/FriendsOfPHP/PHP-CS-Fixer)
	$(EXEC_PHP) php-cs-fixer fix --allow-risky=yes --dry-run --diff --verbose

php-cs-fixer-fix: ## Исправить ошибки PHP code style при помощи PHP CS Fixer (https://github.com/FriendsOfPHP/PHP-CS-Fixer)
	$(EXEC_PHP) php-cs-fixer fix --allow-risky=yes --verbose

psalm: ## Запустить статический анализ PHP кода при помощи Psalm (https://psalm.dev/)
	$(EXEC_PHP) psalm

dephpend: ## Проверить код на нарушения архитектуры при помощи dePHPend (https://dephpend.com/)
	$(EXEC_PHP) bin/dephpend

phpmd: ## Проанализировать PHP код при помощи PHPMD (https://phpmd.org/)
	$(EXEC_PHP) phpmd src json phpmd.xml

composer-validate: ## Провалидировать composer.json и composer.lock при помощи встроенного в Composer валидатора
	$(COMPOSER) validate

composer-require-checker: ## Обнаружить неявные зависимости от внешних пакетов при помощи ComposerRequireChecker (https://github.com/maglnet/ComposerRequireChecker)
	$(EXEC_PHP) composer-require-checker check

.PHONY: check phpunit lint-yaml php-cs-fixer php-cs-fixer-fix psalm dephpend phpmd composer-validate composer-require-checker

#
# Вспомогательные рецепты
# -----------------------

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-24s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m## /[33m/' && printf "\n"

.PHONY: help

.DEFAULT_GOAL := help
