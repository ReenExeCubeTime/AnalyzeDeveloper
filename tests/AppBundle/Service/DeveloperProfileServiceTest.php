<?php

namespace Tests\AppBundle\Service;

class DeveloperProfileServiceTest extends AbstractServiceTest
{
    public function test()
    {
        $user = $this->container->get('rqs.user')->getUser();

        $title = 'Senior Developer';
        $salary = 5000;
        $description = 'All';

        $developerProfile = $this->getService()->create(
            $user,
            $title,
            $salary,
            $description
        );

        $this->assertSame($developerProfile->getTitle(), $title);
        $this->assertSame($developerProfile->getSalary(), $salary);
        $this->assertSame($developerProfile->getDescription(), $description);
    }

    private function getService()
    {
        return $this->container->get('rqs.developer_profile');
    }
}
