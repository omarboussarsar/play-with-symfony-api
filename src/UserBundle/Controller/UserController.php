<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\Type\UserType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Description of UserController
 *
 * @author omar
 */
class UserController extends Controller
{
    /**
     * @ApiDoc(
     *  section="Users",
     *  statusCodes={
     *      200="Returned when successful",
     *      403="Returned when the user is not authorized",
     *  },
     *  resource=true,
     *  description="get all the users",
     * )
     * @return User[]
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getUsersAction()
    {
        return $this->getDoctrine()->getRepository('UserBundle:User')->findAll();
    }

    /**
     * @ApiDoc(
     * section="Users",
     *  statusCodes={
     *      200="Returned when successful",
     *      403="Returned when the user is not authorized",
     *      404="Returned when the user is not found"
     *  },
     *  resource=true,
     *  description="get a specific user",
     * )
     * @return User
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getUserAction(User $user)
    {
        return $user;
    }

    /**
     * @ApiDoc(
     *  section="Users",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when validation failed",
     *      403="Returned when the user is not authorized"
     *  },
     *  resource=true,
     *  description="add a user",
     *  input="UserBundle\Form\Type\UserType",
     * )
     * @return User
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
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

    /**
     * @ApiDoc(
     *  section="Users",
     *  statusCodes={
     *      200="Returned when successful",
     *      403="Returned when the user is not authorized",
     *      404="Returned when the user is not found"
     *  },
     *  resource=true,
     *  description="delete a specific user",
     * )
     * @return bool
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function deleteUserAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        
        return true;
    }
}
