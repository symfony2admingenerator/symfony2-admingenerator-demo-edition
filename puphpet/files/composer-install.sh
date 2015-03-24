#!/bin/bash
PUPPET_DIR=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")
APP_DIR=/var/www/public_html
SYMFONY__VAGRANT_ENV=generator

cd "${APP_DIR}"

echo 'Vendors setup'
sudo composer self-update
composer install
