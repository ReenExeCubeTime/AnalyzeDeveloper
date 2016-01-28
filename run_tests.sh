#!/bin/bash
bin/console doctrine:migrations:migrate -n
php vendor/bin/phpunit --coverage-clover=coverage.clover