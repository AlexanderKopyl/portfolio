DOCKER_COMPOSE = docker-compose
EXEC_PHP       = $(DOCKER_COMPOSE) exec php /bin/bash
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

.PHONY: install start stop kill clean reinstall nd

php:
	$(EXEC_PHP)
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
