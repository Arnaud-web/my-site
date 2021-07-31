<?php

namespace App\Form;

use App\Entity\PostReponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('createdAt')
            ->add('reponse')
            ->add('dateEntretien')
            ->add('statu')
//            ->add('post')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PostReponse::class,
        ]);
    }
}
