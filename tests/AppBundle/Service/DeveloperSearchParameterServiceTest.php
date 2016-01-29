<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\DeveloperSearchParameterParser;

class DeveloperSearchParameterServiceTest extends AbstractServiceTest
{
    public function testEmpty()
    {
        $this->container->get('rqs.database.tester')->clear();

        $this->assertSame($this->getService()->getFilter(), []);
    }

    public function testFill()
    {
        $this->container->get('rqs.database.tester')->clear();

        $allSkills = [
            'PHP',
            'Redis',
            'SQL',
            'JavaScript',
            'TDD',
        ];

        $this->container->get('rqs.skill')->create(...$allSkills);

        $this->assertSame(
            $this->getService()->getFilter(),
            [
                DeveloperSearchParameterParser::SKILL_NAME => [
                    'param' => DeveloperSearchParameterParser::SKILL,
                    'name' => DeveloperSearchParameterParser::SKILL_NAME,
                    'list' => $allSkills,
                ]
            ]
        );
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.profile.parameter');
    }
}
