.PHONY: all update-repo dependency-install unit-tests file-permission

all: update-repo dependency-install unit-tests file-permission

update-repo:
	sudo git reset --hard
	sudo git pull origin master

dependency-install:
	sudo composer update

unit-tests:
	vendor/bin/phpunit

file-permission:
	chmod 777 application/logs
	chmod 777 application/cache
	chmod 777 application/models/proxies
