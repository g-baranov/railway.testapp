PORT ?= 80
start:
	php bin/console doctrine:migrations:migrate
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT) -t public