<?php

namespace Tests\AppBundle\Service;

use AppBundle\Services\SkillService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DeveloperProfileServiceTest extends KernelTestCase
{
    /**
     * @var SkillService
     */
    private $service;

    public function setUp()
    {
        static::bootKernel();

        $this->service = static::$kernel->getContainer()->get('rqs.developer_profile');
    }

    public function test()
    {

    }
}
