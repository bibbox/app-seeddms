#!/usr/bin/env bash
mkdir -p data/var/lib/mysql
mkdir -p data/var/www/seeddms60x/data/lucene
mkdir -p data/var/www/seeddms60x/data/staging
chmod -R 777 data

sudo docker network create bibbox-default-network

docker-compose up -d
