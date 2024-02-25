<?php

namespace App\Form;

use App\Entity\Compte;
use App\Entity\Proprietaire;
use App\Entity\Vehicule;
use App\Entity\Vendeur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Valid;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroFiche',TextType::class,[
                'label'=>'Numéro de Fiche *',
                'attr' => [
                    'class'=>"form-control form-control-sm",
                    'maxLength' => 5, // Maximum length allowed is 5
                 ]
            ])
            ->add('dateCircul',DateType::class,[
                'label'=>'Date de mise en circulation',
                'widget' => 'single_text',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('dateAchat',DateType::class,[
                'label'=>'Date achat',
                'widget' => 'single_text',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('marque',TextType::class,[
                'label'=>'Marque',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('modele',TextType::class,[
                'label'=>'Modèle',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('version',TextType::class,[
                'label'=>'Version',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('VIN',TextType::class,[
                'label'=>'VIN *',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ]
            ])
            ->add('matricule',TextType::class,[
                'label'=>'Immatriculation',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('prospect',TextType::class,[
                'label'=>'Type de prospect',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('kilometrage',TextType::class,[
                'label'=>'Kilométrage',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('energie',TextType::class,[
                'label'=>'Energie',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            ->add('typeVehicule',TextType::class,[
                'label'=>'Type VN VO',
                'attr' => [
                    'class'=>"form-control form-control-sm",
                    'maxLength' => 2, // Maximum length allowed is 2 : VN VO
                ],
                'required'=>false
            ])
            ->add('numeroDossier',TextType::class,[
                'label'=>'Numéro de Dossier',
                'attr' => [
                    'class'=>"form-control form-control-sm"
                ],
                'required'=>false
            ])
            /*Nested forms */
                ->add('proprietaire', ProprietaireType::class, [
                    'label'=>false,
                ])
                ->add('compte', CompteType::class, [
                    'label'=>false,
                ])
                ->add('vendeur', VendeurType::class, [
                    'label'=>false,
                ])
            /*********************** */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
