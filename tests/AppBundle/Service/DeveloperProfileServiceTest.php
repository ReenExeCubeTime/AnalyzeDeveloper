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

        $skillService->create(...$skills);

        $title = 'Senior Developer';
        $salary = 5000;
        $description = 'All';

        $developerProfile = $this->getService()->create(
            $this->getTestUser(),
            $title,
            $salary,
            $description,
            $this->getCity(),
            $skills
        );

        $skillCount = count($skills);

        $this->assertSame($developerProfile->getUser(), $this->getTestUser());
        $this->assertSame($developerProfile->getCity(), $this->getCity());
        $this->assertSame($developerProfile->getTitle(), $title);
        $this->assertSame($developerProfile->getSalary(), $salary);
        $this->assertSame($developerProfile->getDescription(), $description);
        $this->assertSame($developerProfile->getSkills()->count(), $skillCount);

        $skillBitSet = $this->container->get('rqs.developer.profile.search.parameter')->getSkillBitSet();

        while($index = $skillCount--) {
            $skillBitSet[$index] = '1';
        }

        $this->assertSame($developerProfile->getSearchParameter()->getSkillBitSet(), $skillBitSet);
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.profile');
    }
}
