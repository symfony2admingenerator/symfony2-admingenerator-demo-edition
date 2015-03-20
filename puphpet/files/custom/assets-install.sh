#!/bin/bash

VAGRANT_CORE_FOLDER=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")

cd /var/www/public_html

if [ ! -d /var/www/public_html/app ]; then
	exit
fi

echo 'Dumping assets'
php bin/console admin:assets-install
php bin/console assets:install web
php bin/console assetic:dump
# php bin/console assetic:dump -e prod
