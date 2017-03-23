<?php

namespace UserBundle\Utils;

/**
 * Description of WebServiceChain
 *
 * @author omar
 */
class ServiceChain {

    private $services;

    public function __construct() {
        $this->services = array();
    }

    public function addService($service, $alias) {
        $this->services[$alias] = $service;
    }

    public function getService($alias) {
        if (array_key_exists($alias, $this->services)) {
            return $this->services[$alias];
        }
    }

}
