<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\Type\UserType;

/**
 * Description of UserController
 *
 * @author omar
 */
class UserController extends Controller
{

    //Get all the users
    //"api_get_users"            [GET] /api/users
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('UserBundle:User')->findAll();
        if (!is_array($users) || !count($users)) {
            throw $this->createNotFoundException();
        }
        return $users;
    }

    //Get a specific user by id
    //"api_get_user"             [GET] /users/{id}
    public function getUserAction($id)
    {
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneById($id);
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        return $user;
    }

    //Add an user
    //"api_post_users"           [POST] /users
    public function postUsersAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        return $user;
    }

    //Delete a specific user
    //"api_delete_user"          [DELETE] /users/{id}
    public function deleteUserAction($id)
    {
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneById($id);
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return true;
    }
}
