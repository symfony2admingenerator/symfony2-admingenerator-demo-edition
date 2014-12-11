#!/bin/bash
if [ ! -d /tmp/generator ]; then
	mkdir /tmp/generator
fi

chmod g+ws /tmp/generator
chown vagrant:www-data /tmp/generator