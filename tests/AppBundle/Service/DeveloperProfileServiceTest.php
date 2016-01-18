<?php

namespace Tests\AppBundle\Service;

class DeveloperProfileServiceTest extends AbstractServiceTest
{
    public function test()
    {

    }

    private function getService()
    {
        return $this->container->get('rqs.developer_profile');
    }
}
