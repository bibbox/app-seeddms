#!/usr/bin/env bash
mkdir -p data/var/lib/mysql
mkdir -p data/var/www/seeddms60x/data/lucene
mkdir -p data/var/www/seeddms60x/data/staging
chmod -R 777 data
docker-compose up -d
