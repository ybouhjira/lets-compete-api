#!/bin/bash 
set -e
export SYMFONY_ENV=test
bin/console doctrine:schema:drop -f
bin/console doctrine:schema:create 
bin/console hautelook:fixtures:load -n

