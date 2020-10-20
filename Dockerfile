# seeddms installation
# 
# VERSION 1.2
#

FROM php:7.0-apache-jessie
MAINTAINER Heimo Müller

ENV SEEDDMS_VERSION=6.0.12

RUN apt-get update && apt-get install -y apt-utils && apt-get install -my wget gnupg

RUN echo 'deb http://packages.dotdeb.org jessie all' > /etc/apt/sources.list.d/dotdeb.list && \
    curl http://www.dotdeb.org/dotdeb.gpg | apt-key add -

RUN rm /etc/apt/preferences.d/no-debian-php && \
    apt-get update && \
    apt-get -q -y install \
        libpng-dev \
        imagemagick \
        libmcrypt-dev \
        php-pear \
        poppler-utils \
        catdoc \
        curl \
        php7.0-json \
        php7.0-ldap \
        php7.0-mbstring \
        php7.0-mysql \
        php7.0-sqlite3 \
        php7.0-xml \
        php7.0-xsl \
        php7.0-zip \
        php7.0-soap \
        mysql-client \
          libmysqlclient-dev

RUN docker-php-ext-install gd mysqli pdo pdo_mysql

RUN a2enmod php7 && a2enmod rewrite && a2enmod dav && a2enmod dav_fs

RUN curl -L https://sourceforge.net/projects/seeddms/files/seeddms-$SEEDDMS_VERSION/SeedDMS_Core-$SEEDDMS_VERSION.tgz/download > SeedDMS_Core-$SEEDDMS_VERSION.tgz  && \
curl -L https://sourceforge.net/projects/seeddms/files/seeddms-$SEEDDMS_VERSION/seeddms-quickstart-$SEEDDMS_VERSION.tar.gz/download > seeddms-quickstart-$SEEDDMS_VERSION.tar.gz

RUN tar xvzf seeddms-quickstart-$SEEDDMS_VERSION.tar.gz --directory /var/www && \
pear -v 1 install SeedDMS_Core-$SEEDDMS_VERSION.tgz  && \
pear -v 1 install Log && pear channel-discover pear.dotkernel.com/zf1/svn && pear install zend/zend && pear install HTTP_WebDAV_Server-1.0.0RC8 && \
rm -R seeddms*

COPY configs/create_tables-innodb.sql /var/www/seeddms60x/install/create_tables-innodb.sql
COPY configs/php.ini /usr/local/etc/php/
COPY configs/000-default.conf /etc/apache2/sites-available/
COPY configs/settings.xml /var/www/seeddms60x/conf/settings.xml

RUN chown -R www-data:www-data /var/www/seeddms60x/

RUN touch /var/www/seeddms60x/conf/ENABLE_INSTALL_TOOL
RUN apt-get update
#RUN apt-get install nano
