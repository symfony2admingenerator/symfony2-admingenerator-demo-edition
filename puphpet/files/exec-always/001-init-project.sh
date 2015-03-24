#!/bin/bash
PUPPET_DIR=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")
APP_DIR=/var/www/public_html
SYMFONY__VAGRANT_ENV=generator

. "${PUPPET_DIR}"/files/dump-paramters.sh
. "${PUPPET_DIR}"/files/init-temp.sh
. "${PUPPET_DIR}"/files/composer-install.sh
. "${PUPPET_DIR}"/files/cache-clear.sh
. "${PUPPET_DIR}"/files/assets-install.sh
. "${PUPPET_DIR}"/files/init-database.sh
