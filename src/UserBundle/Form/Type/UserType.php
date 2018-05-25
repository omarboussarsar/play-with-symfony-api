<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Description of UserType
 *
 * @author omar
 */
class UserType extends AbstractType {

    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username', TextType::class, array(
                    'required' => true,
                ))
                ->add('email', EmailType::class, array(
                    'required' => true,
                ))
                ->add('firstname', TextType::class, array(
                    'required' => false,
                ))
                ->add('name', TextType::class, array(
                    'required' => false,
                ))
                ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Confirm password'),
                    'invalid_message' => "passwords don't match",
                ))
        ;
    }

}
