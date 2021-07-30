<?php

namespace App\Form;

use App\Entity\PostEmploi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostEmploiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lettre',TextareaType::class,[
                'label'=>'Lettre de motivation'
            ])
//            ->add('postAt')
//            ->add('article')
//            ->add('userPost')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PostEmploi::class,
        ]);
    }
}
