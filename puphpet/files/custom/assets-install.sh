#!/bin/bash

VAGRANT_CORE_FOLDER=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")

cd /var/www

if [ ! -d /var/www/app ]; then
	exit
fi

echo 'Dumping assets'
php bin/console assets:install web
php bin/console assetic:dump
php bin/console assetic:dump -e prod
