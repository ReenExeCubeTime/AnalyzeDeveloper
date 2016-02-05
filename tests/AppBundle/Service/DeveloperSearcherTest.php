<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\DeveloperSearchParameterParser;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearcherTest extends AbstractServiceTest
{
    protected function setUp()
    {
        parent::setUp();

        $this->createDeveloperList();
    }

    /**
     * @covers \AppBundle\Service\DeveloperSearcherService::search
     * @dataProvider dataProvider
     * @param array $parameters
     * @param array $expectDeveloperProfileIdList
     */
    public function test(array $parameters, array $expectDeveloperProfileIdList)
    {
        $developerProfileCollection = $this->search($parameters);

        $this->assertSame(
            $this->getDeveloperProfileIdList($developerProfileCollection),
            $expectDeveloperProfileIdList
        );
    }

    public function dataProvider()
    {
        yield [
            [],
            [1, 2, 3]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => ''
            ],
            [1, 2, 3]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => 'PHP,Redis,SQL,JavaScript,TDD'
            ],
            [1]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => 'PHP'
            ],
            [1, 2, 3]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => 'PHP,JavaScript'
            ],
            [1, 2]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => 'PHP,SQL'
            ],
            [1, 3]
        ];
    }

    public function testFilter()
    {
        $this->assertSame(
            $this->getCriteriaService()->getFilter(),
            [
                DeveloperSearchParameterParser::SKILL_NAME => [
                    'param' => DeveloperSearchParameterParser::SKILL,
                    'name' => DeveloperSearchParameterParser::SKILL_NAME,
                    'list' => $this->getSkillList(),
                ]
            ]
        );
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.searcher');
    }

    private function getCriteriaService()
    {
        return $this->container->get('rqs.developer.profile.parameter');
    }

    private function createDeveloperList()
    {
        $this->container->get('rqs.database.tester')->clear();

        $allSkills = $this->getSkillList();

        $this->container->get('rqs.skill')->create(...$allSkills);

        $developerProfileDataList = [
            [
                'Senior Developer',
                5000,
                'All',
                $allSkills,
            ],

            [
                'Middle Developer',
                2500,
                'Some',
                ['PHP', 'JavaScript'],
            ],

            [
                'Junior Developer',
                1000,
                'Some',
                ['PHP', 'SQL'],
            ],
        ];

        foreach ($developerProfileDataList as list($title, $salary, $description, $skills)) {
            $this->container->get('rqs.developer.profile')->create(
                $this->getTestUser(),
                $title,
                $salary,
                $description,
                $this->getCity(),
                $skills
            );
        }
    }

    /**
     * @param array $parameters
     * @return \AppBundle\Entity\SDeveloperProfile[]|array
     */
    private function search(array $parameters)
    {
        return $this->getService()->search(new ParameterBag($parameters));
    }

    private function getSkillList()
    {
        return [
            'PHP',
            'Redis',
            'SQL',
            'JavaScript',
            'TDD',
        ];
    }

    /**
     * @param \AppBundle\Entity\SDeveloperProfile[]|array $developerProfileCollection
     * @return array
     */
    private function getDeveloperProfileIdList(array $developerProfileCollection)
    {
        $developerProfileIdList = [];
        foreach ($developerProfileCollection as $developerProfile) {
            $developerProfileIdList[] = $developerProfile->getId();
        }
        return $developerProfileIdList;
    }
}
