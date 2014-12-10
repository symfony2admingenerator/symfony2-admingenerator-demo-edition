#!/bin/bash
if [ ! -d /tmp/generator ]; then
	mkdir /tmp/generator
	chmod g+ws /tmp/generator
	chown `whoami`:www-data /tmp/generator
fi