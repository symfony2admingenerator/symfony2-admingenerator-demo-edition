#!/bin/bash
export SYMFONY__VAGRANT__ENV=generator

VAGRANT_CORE_FOLDER=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")

cd /var/www/public_html

if [ ! -d /var/www/public_html/app ]; then
	exit
fi

echo 'Dumping parameters.yml file'
cat "${VAGRANT_CORE_FOLDER}"/files/custom/parameters.yml > app/config/parameters.yml
if [ `whoami` = 'root' ]; then
    chown vagrant: app/config/parameters.yml
fi

echo 'Vendors setup'
sudo composer self-update
composer install

. "${VAGRANT_CORE_FOLDER}"/files/custom/cache-clear.sh
. "${VAGRANT_CORE_FOLDER}"/files/custom/assets-install.sh

echo 'Populating DB'
php bin/console doctrine:schema:drop --force
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load -n

# cd web

# rm -rf images
# tar -jxvf ../puphpet/files/custom/images.tgz
# cd ..
