<?php

namespace Tests\AppBundle\Service;

class SkillServiceTest extends AbstractServiceTest
{
    /**
     * @covers \AppBundle\Service\SkillService::create
     */
    public function test()
    {
        $this->getService()->clear();

        $this->getService()->create('PHP');

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
