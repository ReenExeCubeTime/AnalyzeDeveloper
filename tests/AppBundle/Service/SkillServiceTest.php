<?php

namespace Tests\AppBundle\Service;

class SkillServiceTest extends AbstractServiceTest
{
    /**
     * @covers \AppBundle\Service\SkillService::create
     * @covers \AppBundle\Service\SkillService::exists
     */
    public function test()
    {
        $this->container->get('rqs.database_tester')->truncate('SSkill');

        $this->getService()->create('PHP');

        $this->assertTrue($this->getService()->exists('PHP'));

        $expected = ['PHP'];
        foreach (['PHP', 'PH', 'P', 'php', 'ph', 'p'] as $value) {
            $this->assertSame($this->getService()->findAllLike($value), $expected);
        }
    }

    private function getService()
    {
        return $this->container->get('rqs.skill');
    }
}
