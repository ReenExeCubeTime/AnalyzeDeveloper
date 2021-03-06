<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\SCity;
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
    }

    /**
     * @return SUser
     */
    protected function getTestUser()
    {
        return $this->container->get('rqs.user')->getUser();
    }

    /**
     * @param int $id
     * @return SCity
     */
    protected function getCity($id = 1)
    {
        /* @var $manager \Doctrine\ORM\EntityManager */
        $manager = $this->container->get('doctrine')->getManager();

        return $manager->getReference('AppBundle:SCity', $id);
    }

    protected function getSkillList()
    {
        return [
            1 => 'PHP',
            'Redis',
            'SQL',
            'JavaScript',
            'TDD',
        ];
    }

    protected function getCityList()
    {
        return [
            1 => 'Київ',
            'Львів',
        ];
    }
}
