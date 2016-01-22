#!/bin/bash
bin/console doctrine:migrations:migrate -n
php vendor/bin/codecept run
php vendor/bin/phpunit