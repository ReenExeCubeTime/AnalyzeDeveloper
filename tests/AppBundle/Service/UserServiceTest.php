<?php

namespace Tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserServiceTest extends KernelTestCase
{
    private $container;

    public function testIndex()
    {
        static::bootKernel();

        $this->container = static::$kernel->getContainer();
    }

    public function test()
    {

    }
}
