<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of UserRestController
 *
 * @author omar
 */
class UserRestController extends Controller {

    //Get all the users
    //"api_get_users"            [GET] /api/users
    public function getUsersAction() {
        $users = $this->getDoctrine()->getRepository('UserBundle:User')->findAll();
        if (!is_array($users) || !count($users)) {
            throw $this->createNotFoundException();
        }
        return $users;
    }

    //Get a specific user by id
    //"api_get_user"             [GET] /users/{id}
    public function getUserAction($id) {
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneById($id);
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        return $user;
    }

}
