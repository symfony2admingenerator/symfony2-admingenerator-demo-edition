#!/bin/bash
PUPPET_DIR=$(cat "/.puphpet-stuff/vagrant-core-folder.txt")
APP_DIR=/var/www/public_html
SYMFONY__VAGRANT_ENV=generator

echo 'Initializing temp dir'

if [ ! -d /tmp/"${SYMFONY__VAGRANT_ENV}" ]; then
	mkdir /tmp/"${SYMFONY__VAGRANT_ENV}"
fi

if [ ! -d /tmp/"${SYMFONY__VAGRANT_ENV}"/cache ]; then
	mkdir /tmp/"${SYMFONY__VAGRANT_ENV}"/cache
fi

if [ ! -d /tmp/"${SYMFONY__VAGRANT_ENV}"/logs ]; then
	mkdir /tmp/"${SYMFONY__VAGRANT_ENV}"/logs
fi

# Setup permissions
if [ `whoami` = 'root' ]; then
	chmod g+ws /tmp/"${SYMFONY__VAGRANT_ENV}" -R
	chown vagrant:www-data /tmp/"${SYMFONY__VAGRANT_ENV}" -R
else
	sudo chmod g+ws /tmp/"${SYMFONY__VAGRANT_ENV}" -R
	sudo chown vagrant:www-data /tmp/"${SYMFONY__VAGRANT_ENV}" -R
fi