<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of UserSearchType
 *
 * @author omar
 */
class UserSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username', TextType::class, array(
                    'required' => false,
                ))
                ->add('createdFrom', DateType::class, array(
                    'required' => false,
                    'widget' => 'single_text',
                ))
                ->add('createdTo', DateType::class, array(
                    'required' => false,
                    'widget' => 'single_text',
                ))
                ->add('isEnabled', ChoiceType::class, array(
                    'choices' => array(
                        'non' => 'false',
                        'oui' => 'true'
                    ),
                    'required' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        parent::configureOptions($resolver);
        $resolver->setDefaults(array(
            // avoid to pass the csrf token in the url (but it's not protected anymore)
            'csrf_protection' => false,
            'data_class' => 'UserBundle\Model\UserSearch'
        ));
    }

    public function getName() {
        return 'user_search_type';
    }

}
