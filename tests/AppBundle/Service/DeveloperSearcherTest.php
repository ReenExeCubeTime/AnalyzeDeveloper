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
     * @param $count
     * @param $offset
     * @param $limit
     */
    public function test(array $parameters, array $expectDeveloperProfileIdList, $count, $offset = null, $limit = null)
    {
        $parameterBag = new ParameterBag($parameters);

        $developerProfileCollection = $this->getService()->search($parameterBag, $offset, $limit);

        $this->assertSame(
            $this->getDeveloperProfileIdList($developerProfileCollection),
            $expectDeveloperProfileIdList
        );

        $this->assertSame(
            $this->getService()->count($parameterBag),
            $count
        );
    }

    public function dataProvider()
    {
        yield [
            [],
            [1, 2, 3],
            3
        ];

        yield [
            [],
            [1, 2],
            3,
            0,
            2
        ];

        yield [
            [],
            [2, 3],
            3,
            1,
            2
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => ''
            ],
            [1, 2, 3],
            3
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '',
                DeveloperSearchParameterParser::CITY => '',
            ],
            [1, 2, 3],
            3
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1,2,3,4,5'
            ],
            [1],
            1
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1'
            ],
            [1, 2, 3],
            3
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1',
                DeveloperSearchParameterParser::CITY => '1,2',
            ],
            [1, 2, 3],
            3
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => 'PHP',
                DeveloperSearchParameterParser::CITY => '1',
            ],
            [3],
            1
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1,4'
            ],
            [1, 2],
            2
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1,3'
            ],
            [1, 3],
            2
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

    /**
     * @dataProvider presentationDataProvider
     * @param array $parameters
     * @param array $expectDeveloperProfileIdList
     * @param array $expectPager
     */
    public function testPresentation(array $parameters, array $expectDeveloperProfileIdList, array $expectPager)
    {
        $service = $this->getPresentationService();

        $presentation = $service->getPresentation(new ParameterBag($parameters));

        $this->assertSame(
            $this->getDeveloperProfileIdList($presentation->getResults()),
            $expectDeveloperProfileIdList
        );

        $pager = $presentation->getPager();

        $this->assertSame($expectPager, [
            'getCurrentPage' => $pager->getCurrentPage(),
            'getCount' => $pager->getCount(),
            'getPerPage' => $pager->getPerPage(),
            'getPageCount' => $pager->getPageCount(),
        ]);
    }

    public function presentationDataProvider()
    {
        yield [
            [],
            [1, 2, 3],
            [
                'getCurrentPage' => 1,
                'getCount' => 3,
                'getPerPage' => 20,
                'getPageCount' => 1 ,
            ]
        ];
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.searcher');
    }

    private function getCriteriaService()
    {
        return $this->container->get('rqs.developer.profile.parameter');
    }

    private function getPresentationService()
    {
        return $this->container->get('rqs.developer.search.page.presentation');
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
