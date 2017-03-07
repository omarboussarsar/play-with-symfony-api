<?php

namespace UserBundle\Tests\Controller;

use UserBundle\Test\WebTestCase;

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
        //$this->assertEquals(10, $crawler->filter('div.user-informations')->count());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

//    public function testGet() {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/user/omarboussarsar');
//        $this->assertContains('Delete', $client->getResponse()->getContent());
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//    }
//
//    public function testAdd() {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/add');
//        $this->assertContains('Back to the list', $client->getResponse()->getContent());
//
////        $crawler = $client->request('POST', '/add');
//    }
//
//    public function testDelete() {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/supprimer/omarboussarsar');
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//    }

}
