<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\SCity;

class CityServiceTest extends AbstractServiceTest
{
    /**
     * @covers \AppBundle\Service\CityService::create
     * @covers \AppBundle\Service\CityService::find
     */
    public function test()
    {
        $this->container->get('rqs.database.tester')->truncate('SCity');

        $id = 1;
        $name = 'Київ';

        $this->getService()->create($name);

        $city = $this->getService()->find($id);

        $this->assertInstanceOf(SCity::class, $city);
        $this->assertSame($city->getId(), $id);
        $this->assertSame($city->getName(), $name);
    }

    private function getService()
    {
        return $this->container->get('rqs.city');
    }
}
