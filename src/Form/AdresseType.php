<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('voie',TextType::class,[
                'label'=>'N° et Nom de la voie',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('codePostal',TextType::class,[
                'label'=>'Code Postal *',
                'attr' => [
                    'class'=>"form-control form-control-sm",
                    'maxLength' => 5, // Maximum length allowed is 5
                ]
            ])
            ->add('ville',TextType::class,[
                'label'=>'Ville *',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ]
            ])
            ->add('complementAdr',TextType::class,[
                'label'=>'Complément adresse 1',
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
            'data_class' => Adresse::class,
        ]);
    }
}
