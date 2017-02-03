<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of UserRestControllerTest
 *
 * @author omar
 */
class UserRestControllerTest extends WebTestCase {

    public function testGetUsers() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/users');
        $response = $client->getResponse();

        $this->assertJsonResponse($response, 200);
    }

    public function testGetUser() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/users/1');
        $response = $client->getResponse();

        $this->assertJsonResponse($response, 200);
    }

    protected function assertJsonResponse($response, $statusCode = 200) {
        $this->assertEquals(
                $statusCode, $response->getStatusCode(), $response->getContent()
        );
        $this->assertTrue(
                $response->headers->contains('Content-Type', 'application/json'), $response->headers
        );
    }

}
