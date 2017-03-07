<?php

namespace UserBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

/**
 * Description of WebTestCase
 *
 * @author omar
 */
class WebTestCase extends BaseWebTestCase {

    protected static function createClient(array $options = array(), array $server = array()) {
        //set HTTP_HOST
        static::bootKernel($options);
        $server['HTTP_HOST'] = static::$kernel->getContainer()->getParameter('domain');
        $client = parent::createClient($options, $server);

        return $client;
    }

}
