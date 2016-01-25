<?php

namespace Tests\AppBundle\Service;

use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearcherServiceTest extends AbstractServiceTest
{
    /**
     * @covers \AppBundle\Service\DeveloperSearcherService::search
     * @dataProvider dataProvider
     * @param array $parameters
     */
    public function test(array $parameters)
    {
        $this->getService()->search(new ParameterBag($parameters));
    }

    public function dataProvider()
    {
        yield [
            []
        ];
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.searcher');
    }
}
