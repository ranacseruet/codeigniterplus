.PHONY: all update-repo dependency-install unit-tests file-permission

all: update-repo dependency-install unit-tests file-permission

update-repo:
	git reset --hard
	git pull origin master

dependency-install:
	/usr/local/bin/composer install
        bower install

generate-proxies:
        vendor/bin/doctrine orm:generate:proxies

unit-tests:
	vendor/bin/phpunit

file-permission:
	chmod 777 application/logs
	chmod 777 application/cache
	chmod 777 application/models/proxies
