<?php

namespace Tests\AppBundle\Service;

use AppBundle\Services\SkillService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SkillServiceTest extends KernelTestCase
{
    /**
     * @var SkillService
     */
    private $service;

    public function setUp()
    {
        static::bootKernel();

        $this->service = static::$kernel->getContainer()->get('rqs.skill');
    }

    public function test()
    {
        $this->service->add('PHP');
    }
}
