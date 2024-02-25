<?php

namespace App\Form;

use App\Entity\Compte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compteAffaire',TextType::class,[
                'label'=>'Compte Affaire',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('compteEvent',TextType::class,[
                'label'=>'Compte évènement (Veh)',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('dernierEvent',TextType::class,[
                'label'=>'Compte dernier évènement (Veh)',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
