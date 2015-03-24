#!/bin/bash
PUPPET_DIR=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")
APP_DIR=/var/www/public_html
SYMFONY__VAGRANT_ENV=generator

cd "${APP_DIR}"

if [ ! -d "${APP_DIR}"/bin ]; then
    exit
fi

echo 'Dumping assets'

php bin/console assets:install web --symlink
php bin/console assetic:dump
php bin/console assetic:dump -e prod
