# seeddms installation
# 
# VERSION 1.0
#

FROM debian:jessie
MAINTAINER Lukas Pessl

ENV SEEDDMS_VERSION=5.0.3
ENV LUCENE_VERSION=1.1.8
ENV PREVIEW_VERSION=1.1.8

RUN apt-get update && apt-get -y install apache2 php7.0  php7.0-mysql php7.0-gd php-pear poppler-utils catdoc curl supervisor

RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/conf /var/log/supervisor /home/www-data

RUN a2enmod php5 && a2enmod rewrite && a2enmod dav && a2enmod dav_fs

COPY configs/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN rm /var/www/html/index.html

RUN curl -L https://sourceforge.net/projects/seeddms/files/seeddms-$SEEDDMS_VERSION/SeedDMS_Core-$SEEDDMS_VERSION.tgz/download > SeedDMS_Core-$SEEDDMS_VERSION.tgz  && \
curl -L https://sourceforge.net/projects/seeddms/files/seeddms-$SEEDDMS_VERSION/seeddms-quickstart-$SEEDDMS_VERSION.tar.gz/download > seeddms-quickstart-$SEEDDMS_VERSION.tar.gz  && \
curl -L https://sourceforge.net/projects/seeddms/files/seeddms-$SEEDDMS_VERSION/SeedDMS_Lucene-$LUCENE_VERSION.tgz/download > seedDMS_Lucene-$LUCENE_VERSION.tgz  && \
curl -L https://sourceforge.net/projects/seeddms/files/seeddms-$SEEDDMS_VERSION/SeedDMS_Preview-$PREVIEW_VERSION.tgz/download > SeedDMS_Preview-$PREVIEW_VERSION.tgz  && \
tar xvzf seeddms-quickstart-$SEEDDMS_VERSION.tar.gz --directory /home/www-data && \
pear install SeedDMS_Core-$SEEDDMS_VERSION.tgz  && \
pear install seedDMS_Lucene-$LUCENE_VERSION.tgz  && \
pear install SeedDMS_Preview-$PREVIEW_VERSION.tgz && \
pear install Log && pear channel-discover pear.dotkernel.com/zf1/svn && pear install zend/zend && \
chown -R www-data:www-data /home/www-data && \ 
rm seeddms*

COPY configs/000-default.conf /etc/apache2/sites-enabled/000-default.conf

VOLUME ["/home/www-data/seeddms50x/data/", "/var/log/apache2/", "/home/www-data/seeddms50x/www/conf/"]

EXPOSE 80 443

VOLUME /var/conf

CMD ["/usr/bin/supervisord"]