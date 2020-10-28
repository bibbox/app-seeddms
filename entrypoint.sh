#!/bin/bash

mkdir /var/www/seeddms60x/www/seeddms777/
cp -R /var/www/seeddms60x/seeddms/* /var/www/seeddms60x/www/seeddms777/
chown -R www-data:www-data /var/www/seeddms60x/www/seeddms777/

#tail -f /var/log/dpkg.log
service apache2 start
tail -f /var/log/dpkg.log
