[Creating a Symfony Application with Composer](http://symfony.com/doc/current/book/installation.html)
```bash
composer create-project symfony/framework-standard-edition app
```

```sql
CREATE DATABASE IF NOT EXISTS `reen` CHARACTER SET `utf8` COLLATE `utf8_bin`;
```

[DoctrineMigrationsBundle](http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html)
```bash
composer require doctrine/doctrine-migrations-bundle "^1.0"
```

[Using Codeception for Symfony Projects](http://codeception.com/09-04-2015/using-codeception-for-symfony-projects.html)
```bash
composer require --dev "codeception/codeception:~2.1"
```

```
php vendor/bin/codecept bootstrap
php vendor/bin/codecept run
```

[Behat] (https://github.com/Behat/Behat)
```bash
composer require --dev behat/behat
```

[Doctrine]
```bash
bin/console doctrine:generate:entities AppBundle
```

[PHPUnit `dataProvider` call before `setUp`] (https://github.com/sebastianbergmann/phpunit/issues/836)