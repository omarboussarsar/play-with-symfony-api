<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of UserControllerTest
 *
 * @author omar
 */
class UserControllerTest extends WebTestCase {

    public function testList() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('List of all the users', $client->getResponse()->getContent());
//        $this->assertContains('List of all the users', $crawler->filter('#container h1')->text());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
