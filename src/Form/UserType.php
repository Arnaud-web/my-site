<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                'attr' => [
                    'placeholder' => 'Email',

                ],
                'label'=>' E-mail'
            ])
            ->add('name',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Name '
                ]
            ])

            //            ->add('roles')
            ->add('password',PasswordType::class,[
                'attr'=>[
                    'placeholder'=>'Password '
                ]
            ])
            ->add('confirm_password',PasswordType::class,[
                'attr'=>[
                    'placeholder'=>'Confirm Password '
                ]
            ])
//            ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
