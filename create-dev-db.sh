#!/bin/bash

set -e

bin/console doctrine:schema:validate --skip-sync

echo "Creating database"
echo 'drop database competition' | mysql -u root && echo 'create database competition' | mysql -u root

echo "Creating schema"
bin/console doctrine:schema:create

echo "Loading fixtures"
bin/console hautelook:fixtures:load -n
