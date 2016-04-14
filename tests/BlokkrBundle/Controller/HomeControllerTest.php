<?php

namespace Tests\BlokkrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request("GET", "/");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}