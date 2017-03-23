<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Model\UserSearch;
use UserBundle\Form\Type\UserSearchType;
use UserBundle\Entity\User;
use UserBundle\Form\Type\UserType;

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
    
    //Add a user
    public function addAction(Request $request) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parameters = $request->request->all();
            $url = $this->generateUrl('api_post_users', array(), UrlGeneratorInterface::ABSOLUTE_URL);
            $data = $this->container->get('user.web_service_tools')->getData('POST', $url, $parameters);
            if (isset($data->username)) {
                return $this->redirect($this->generateUrl(
                    'user_get', array('username' => $data->username)
                ));
            }
        }
        return $this->render('UserBundle:User:add.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    //Delete a specific user
    public function deleteAction($username) {
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneByUsername($username);
        if(!is_object($user)){
            throw $this->createNotFoundException();
        }
        $url = $this->generateUrl('api_delete_user', array('id' => $user->getId()), UrlGeneratorInterface::ABSOLUTE_URL);
        $data = $this->container->get('user.web_service_tools')->getData('DELETE', $url);
        return $this->redirect($this->generateUrl(
            'user_list', array(
                'is_deleted' => $data,
                'username' => $username
            )
        ));
    }

    //Search users with elastica
    public function searchAction(Request $request) {
        $userSearch = new UserSearch();

        $form = $this->createForm(UserSearchType::class, $userSearch);

        $form->handleRequest($request);
        $userSearch = $form->getData();

        $elasticaManager = $this->container->get('fos_elastica.manager');
        $users = $elasticaManager->getRepository('UserBundle:User')->search($userSearch);

        return $this->render('UserBundle:User:search.html.twig', array(
                    'users' => $users,
                    'form' => $form->createView(),
        ));
    }

}
