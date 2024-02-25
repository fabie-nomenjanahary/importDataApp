<?php

namespace App\Form;

use App\Entity\Vendeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vendeurVN',TextType::class,[
                'label'=>'Vendeur VN',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('vendeurVO',TextType::class,[
                'label'=>'Vendeur VO',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('intermediaire',TextType::class,[
                'label'=>'Intermediaire de vente VN',
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
            'data_class' => Vendeur::class,
        ]);
    }
}
