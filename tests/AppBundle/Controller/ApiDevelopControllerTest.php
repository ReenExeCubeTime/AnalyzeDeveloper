<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiDevelopControllerTest extends WebTestCase
{
    public function testEmpty()
    {
        $client = static::createClient();

        $container = static::$kernel->getContainer();

        $container->get('rqs.database.tester')->clear();

        $client->request('GET', '/api/developers.json');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('[]', $client->getResponse()->getContent());
    }
}
