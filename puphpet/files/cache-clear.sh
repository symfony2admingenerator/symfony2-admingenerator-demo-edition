#!/bin/bash
PUPPET_DIR=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")
APP_DIR=/var/www/public_html
SYMFONY__VAGRANT_ENV=generator

cd "${APP_DIR}"

if [ ! -d "${APP_DIR}"/bin ]; then
    exit
fi

echo 'Initializing cache'

php bin/console cache:clear -e=dev --no-warmup --no-optional-warmers
php bin/console cache:clear -e=prod --no-warmup --no-optional-warmers

php bin/console cache:warmup -e=dev
php bin/console cache:warmup -e=prod


if [ `whoami` = 'root' ]; then
    if [ ! -d "/tmp/${SYMFONY__VAGRANT__ENV}" ]; then
        mkdir "/tmp/${SYMFONY__VAGRANT__ENV}"
    fi
    chown -R vagrant: "/tmp/${SYMFONY__VAGRANT__ENV}"
    find "/tmp/${SYMFONY__VAGRANT__ENV}" -type d -exec chmod 775 {} \; -exec chmod g+s {} \;
fi

echo 'Restarting Apache'
sudo /etc/init.d/apache2 restart
