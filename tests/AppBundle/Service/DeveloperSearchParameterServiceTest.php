<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\DeveloperSearchParameterParser;

class DeveloperSearchParameterServiceTest extends AbstractServiceTest
{
    public function testEmpty()
    {
        $this->container->get('rqs.database.tester')->clear();

        $this->assertSame($this->getService()->getFilter(), []);
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.profile.parameter');
    }
}
