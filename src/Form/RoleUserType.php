<?php

namespace App\Form;

use App\Entity\RoleUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roleU',EntityType::class,[
                'class'=> Role::class,
                'choice_label' => 'nomRole',
                'mapped' =>false,
                'label'=>'Role',
                'attr' =>[
                    'class' =>'mx-2 form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoleUser::class,
        ]);
    }
}
