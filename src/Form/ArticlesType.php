<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Regions;
use App\Entity\Utilisateurs;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomArticle',TextType::class)
            ->add('descriptionArticle',TextareaType::class)
            ->add('prixArticle',NumberType::class)
            ->add('photoArticle',FileType::class,[
                'label'=> 'image de l\'annonce',
                'data_class'=> null,
            ])
            ->add('categories',EntityType::class,[
                'class' => Categories::class,
            'choice_label' =>'nomCategorie'
            ])
            ->add('region',EntityType::class,[
                'class' => Regions::class,
            'choice_label' => 'nomRegion'
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
