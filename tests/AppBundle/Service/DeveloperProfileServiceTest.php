<?php

namespace Tests\AppBundle\Service;

class DeveloperProfileServiceTest extends AbstractServiceTest
{
    /**
     * @covers \AppBundle\Service\DeveloperProfileService::create
     */
    public function test()
    {
        $skillService = $this->container->get('rqs.skill');

        $this->container->get('rqs.database.tester')->clear();

        $skills = [
            'PHP',
            'Redis',
            'SQL',
            'JavaScript',
            'TDD',
        ];

        foreach ($skills as $skillName) {
            $skillService->create($skillName);
        }

        $title = 'Senior Developer';
        $salary = 5000;
        $description = 'All';

        $developerProfile = $this->getService()->create(
            $this->getTestUser(),
            $title,
            $salary,
            $description,
            $skills
        );

        $this->assertSame($developerProfile->getUser(), $this->getTestUser());
        $this->assertSame($developerProfile->getTitle(), $title);
        $this->assertSame($developerProfile->getSalary(), $salary);
        $this->assertSame($developerProfile->getDescription(), $description);
        $this->assertSame($developerProfile->getSkills()->count(), count($skills));
    }

    private function getService()
    {
        return $this->container->get('rqs.developer_profile');
    }
}
