<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of UserRestController
 *
 * @author omar
 */
class UserRestController extends Controller {
    public function getUserAction($username){
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneByUsername($username);
        if(!is_object($user)){
            throw $this->createNotFoundException();
        }
        return $user;
    }
}
