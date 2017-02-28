<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of UserControllerTest
 *
 * @author omar
 */
class UserControllerTest extends WebTestCase {

    public function setUp() {
        $client = self::createClient();
        $kernel = $client->getKernel();
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput(array(
           'command' => 'fixtures:load',
            '--no-interaction' => '',
//           '--env' => 'test',
        ));
        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);
        
        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);
    }

    public function testList() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('List of all the users', $client->getResponse()->getContent());
//        $this->assertContains('List of all the users', $crawler->filter('#container h1')->text());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGet() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/omarboussarsar');
        $this->assertContains('Delete', $client->getResponse()->getContent());
    }

    public function testAdd() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
        $this->assertContains('Back to the list', $client->getResponse()->getContent());

//        $crawler = $client->request('POST', '/add');
    }

    public function testDelete() {
        $client = static::createClient();

//        $crawler = $client->request('GET', '/supprimer/omarboussarsar2');
    }

}
