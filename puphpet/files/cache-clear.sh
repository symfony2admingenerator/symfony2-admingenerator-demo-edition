#!/bin/bash
PUPPET_DIR=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")
APP_DIR=/var/www/public_html
SYMFONY__VAGRANT_ENV=generator

cd "${APP_DIR}"

if [ ! -d "${APP_DIR}"/bin ]; then
    exit
fi

echo 'Initializing cache'

. "${PUPPET_DIR}"/files/fix-permissions.sh

php bin/console cache:clear -e=dev --no-warmup --no-optional-warmers
php bin/console cache:clear -e=prod --no-warmup --no-optional-warmers

php bin/console cache:warmup -e=dev
php bin/console cache:warmup -e=prod

. "${PUPPET_DIR}"/files/fix-permissions.sh

echo 'Restarting Apache'
sudo /etc/init.d/apache2 restart
