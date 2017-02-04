#!/bin/bash

set -e

echo 'drop database competition' | mysql -u root && echo 'create database competition' | mysql -u root
bin/console doctrine:schema:create
bin/console hautelook:fixtures:load -n
