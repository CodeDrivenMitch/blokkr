<?php

namespace tests\BlokkrBundle\Controller;

use BlokkrBundle\Entity\Authentication\BlokkrUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    /**
     * Tests the HTTP status response. Should be 404, since the user's profile is not found
     */
    public function testProfileIndexNotFound()
    {
        $profileService = $this->createProfileServiceMock();

        $profileService
            ->method('getProfile')
            ->willReturn(null);

        $client = static::createClient();
        $client->getContainer()->set("blokkr.service.profile", $profileService);
        $client->request("GET", "/profile/1");


        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    /**
     * Tests the HTTP status response. Should be 200, since the user's profile is found
     */
    public function testProfileIndexFound()
    {
        $profileService = $this->createProfileServiceMock();

        $profileService
            ->method('getProfile')
            ->willReturn(new BlokkrUser());

        $client = static::createClient();
        $client->getContainer()->set("blokkr.service.profile", $profileService);
        $client->request("GET", "/profile/1");


        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @return \BlokkrBundle\Services\ProfileService|\PHPUnit_Framework_MockObject_MockObject
     *
     * Creates a generic ProfileService mock.
     */
    private function createProfileServiceMock() {
        return $this->getMockBuilder("BlokkrBundle\\Services\\ProfileService")
            ->disableOriginalConstructor()
            ->getMock();
    }
}