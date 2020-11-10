#!/bin/bash
file=/opt/dist/deployed.done
if [ ! -f $file ] ; then
  mkdir /var/www/seeddms60x/www/§§INSTANCENAME/
  cp -R /var/www/seeddms60x/seeddms/* /var/www/seeddms60x/www/§§INSTANCENAME/
  chown -R www-data:www-data /var/www/seeddms60x/www/§§INSTANCENAME/

  #tail -f /var/log/dpkg.log
  mkdir /opt/dist/
  touch /opt/dist/deployed.done
  service apache2 start
  tail -f /var/log/dpkg.log
fi
