#!/bin/bash

VAGRANT_CORE_FOLDER=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")

cd /var/www/public_html

if [ ! -d /var/www/public_html/app ]; then
	exit
fi


echo 'Initializing cache'
php bin/console cache:clear
php bin/console cache:clear -e prod
if [ `whoami` = 'root' ]; then
    if [ ! -d "/tmp/${SYMFONY__VAGRANT__ENV}" ]; then
        mkdir "/tmp/${SYMFONY__VAGRANT__ENV}"
    fi
    chown -R vagrant: "/tmp/${SYMFONY__VAGRANT__ENV}"
    find "/tmp/${SYMFONY__VAGRANT__ENV}" -type d -exec chmod 775 {} \; -exec chmod g+s {} \;
fi

# echo 'Flushing Redis cache'
# php bin/console redis:flushall --client=cache -n
# php bin/console redis:flushall --client=default -n

echo 'Restarting Apache'
sudo /etc/init.d/apache2 restart
