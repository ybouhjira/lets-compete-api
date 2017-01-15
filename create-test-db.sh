#!/bin/bash 
set -e
rm var/cache/test/db.sqlite || true
rm var/cache/test/db.sqlite.copy || true
export SYMFONY_ENV=test
bin/console doctrine:schema:drop -f
bin/console doctrine:schema:create 
bin/console hautelook:fixtures:load -n
cp var/cache/test/db.sqlite var/cache/test/db.sqlite.copy
