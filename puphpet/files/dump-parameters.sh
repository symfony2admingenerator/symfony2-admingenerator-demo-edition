#!/bin/bash
PUPPET_DIR=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")
APP_DIR=/var/www/public_html
SYMFONY__VAGRANT_ENV=generator

cd "${APP_DIR}"

if [ ! -d "${APP_DIR}"/app ]; then
    exit
fi

echo 'Dumping parameters.yml file'

cat "${PUPPET_DIR}"/files/parameters.yml > app/config/parameters.yml

if [ `whoami` = 'root' ]; then
    chown vagrant: app/config/parameters.yml
fi
