#!/bin/bash

mkdir /var/www/seeddms60x/www/seeddms777/
cp -R /var/www/seeddms60x/seeddms/* seeddms777/
chown -R /var/www/seeddms60x/www/seeddms777/
exec "$@"
