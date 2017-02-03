<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Description of UserController
 *
 * @author omar
 */
class UserController extends Controller {

    //Show all the users
    public function listAction() {
        $url = $this->generateUrl('api_get_users', array(), UrlGeneratorInterface::ABSOLUTE_URL);
        $data = $this->container->get('user.web_service_tools')->getData('GET', $url);
        return $this->render('UserBundle:User:list.html.twig', array(
                    'users' => $data
        ));
    }

    //Show a specific user
    public function getAction($username) {
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneByUsername($username);
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        $url = $this->generateUrl('api_get_user', array('id' => $user->getId()), UrlGeneratorInterface::ABSOLUTE_URL);
        $data = $this->container->get('user.web_service_tools')->getData('GET', $url);
        return $this->render('UserBundle:User:user.html.twig', array(
                    'user' => $data
        ));
    }

}
