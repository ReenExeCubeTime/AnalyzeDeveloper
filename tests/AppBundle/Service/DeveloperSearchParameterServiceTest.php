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

        $developerProfileDataList = [
            [
                'Senior Developer',
                5000,
                'All',
                $allSkills,
            ],
        ];

        foreach ($developerProfileDataList as list($title, $salary, $description, $skills)) {
            $this->container->get('rqs.developer.profile')->create(
                $this->getTestUser(),
                $title,
                $salary,
                $description,
                $skills
            );
        }

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
