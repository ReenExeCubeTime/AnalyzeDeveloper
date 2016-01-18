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
        $this->service->create('PHP');

        $expected = ['PHP'];
        foreach (['PHP', 'PH', 'P', 'php', 'ph', 'p'] as $value) {
            $this->assertSame($this->service->findAllLike($value), $expected);
        }
    }
}
