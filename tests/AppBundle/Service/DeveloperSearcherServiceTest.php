<?php

namespace Tests\AppBundle\Service;

use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearcherServiceTest extends AbstractServiceTest
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
        $developerProfileCollection = $this->getService()->search(new ParameterBag($parameters));

        $developerProfileIdList = [];
        foreach ($developerProfileCollection as $developerProfile) {
            $developerProfileIdList[] = $developerProfile->getId();
        }

        $this->assertSame($developerProfileIdList, $expectDeveloperProfileIdList);
    }

    public function dataProvider()
    {
        yield [
            [],
            [1, 2, 3]
        ];
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.searcher');
    }

    private function createDeveloperList()
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
                [],
            ],

            [
                'Middle Developer',
                2500,
                'Some',
                [],
            ],

            [
                'Junior Developer',
                1000,
                'Some',
                [],
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
    }
}
