<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Regions;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories',EntityType::class,[
                'class'=> Categories::class,
                'choice_label'=>'nomCategorie',
                'required'=> false
            ])

            ->add('region', EntityType::class,[
                'class' => Regions::class,
                'choice_label' => 'nomRegion',
                'required' => false

            ])
            ->add('prixArticle', NumberType::class,[
                'label'=>'prix max',
                'required'=> false,

            ])

            ->add('recherche',SubmitType::class,[
                'label'=> 'recherche'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,

        ]);
    }
}
