<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\SUser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractServiceTest extends KernelTestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected function setUp()
    {
        static::bootKernel();

        $this->container =  static::$kernel->getContainer();

        $this->service = static::$kernel->getContainer();
    }

    /**
     * @return SUser
     */
    protected function getTestUser()
    {
        return $this->container->get('rqs.user')->getUser();
    }
}
