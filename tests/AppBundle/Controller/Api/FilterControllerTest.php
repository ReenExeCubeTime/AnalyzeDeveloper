<?php

namespace Tests\AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiFilterControllerTest extends WebTestCase
{
    public function testEmpty()
    {
        $client = static::createClient();

        $container = static::$kernel->getContainer();
        $container->get('rqs.database.tester')->clear();

        $client->request('GET', '/api/filters.json');

        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
        $this->assertEquals(json_decode($client->getResponse()->getContent(), true), []);
    }
}
