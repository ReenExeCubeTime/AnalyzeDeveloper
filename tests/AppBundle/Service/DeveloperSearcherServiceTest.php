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

    /**
     * @param array $parameters
     * @return \AppBundle\Entity\SDeveloperProfile[]|array
     */
    private function search(array $parameters)
    {
        return $this->getService()->search(new ParameterBag($parameters));
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
