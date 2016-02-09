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
        $parameterBag = new ParameterBag($parameters);

        $developerProfileCollection = $this->getService()->search($parameterBag);

        $this->assertSame(
            $this->getDeveloperProfileIdList($developerProfileCollection),
            $expectDeveloperProfileIdList
        );

        $count = $this->getService()->count($parameterBag);

        $this->assertSame(
            $count,
            count($expectDeveloperProfileIdList)
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
                DeveloperSearchParameterParser::SKILL => '',
                DeveloperSearchParameterParser::CITY => '',
            ],
            [1, 2, 3]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1,2,3,4,5'
            ],
            [1]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1'
            ],
            [1, 2, 3]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1',
                DeveloperSearchParameterParser::CITY => '1,2',
            ],
            [1, 2, 3]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => 'PHP',
                DeveloperSearchParameterParser::CITY => '1',
            ],
            [3]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1,4'
            ],
            [1, 2]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1,3'
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
                    'list' => $this->combine($this->getSkillList()),
                ],

                DeveloperSearchParameterParser::CITY_NAME => [
                    'param' => DeveloperSearchParameterParser::CITY,
                    'name' => DeveloperSearchParameterParser::CITY_NAME,
                    'list' => $this->combine($this->getCityList()),
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

        $allCities = $this->getCityList();
        $this->container->get('rqs.city')->create(...$allCities);

        $developerProfileDataList = [
            [
                'Senior Developer',
                5000,
                'All',
                $allSkills,
                2,
            ],

            [
                'Middle Developer',
                2500,
                'Some',
                ['PHP', 'JavaScript'],
                2,
            ],

            [
                'Junior Developer',
                1000,
                'Some',
                ['PHP', 'SQL'],
                1,
            ],
        ];

        foreach ($developerProfileDataList as list($title, $salary, $description, $skills, $cityId)) {
            $this->container->get('rqs.developer.profile')->create(
                $this->getTestUser(),
                $title,
                $salary,
                $description,
                $this->getCity($cityId),
                $skills
            );
        }
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

    private function combine(array $names)
    {
        $result = [];
        foreach ($names as $id => $name) {
            $result[] = [
                'id' => $id,
                'name' => $name,
            ];
        }

        return $result;
    }
}
