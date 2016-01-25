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
            [1]
        ];
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.searcher');
    }

    private function createDeveloperList()
    {
        $this->container->get('rqs.database.tester')->clear();

        $skills = [
            'PHP',
            'Redis',
            'SQL',
            'JavaScript',
            'TDD',
        ];

        $this->container->get('rqs.skill')->create(...$skills);

        $title = 'Senior Developer';
        $salary = 5000;
        $description = 'All';

        $developerProfile = $this->container->get('rqs.developer_profile')->create(
            $this->getTestUser(),
            $title,
            $salary,
            $description
        );
    }
}
