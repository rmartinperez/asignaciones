<?php

namespace RMP\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// Usamos los diferentes tipo de campo
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('role', ChoiceType::class, array(
                    'choices' => array(
                        'Administrator' => 'ROLE_ADMIN',
                        'User' => 'ROLE_USER'
                    ),
                    'choices_as_values' => true,
                    'placeholder' => 'Choose your gender',
                ))
            ->add('isActive')
            ->add('save', SubmitType::class, array('label' => 'Save user'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RMP\UserBundle\Entity\User'
        ));
    }
}
