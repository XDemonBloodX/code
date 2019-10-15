<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{   
     public function getConfiguration($label, $placeholder,$option=[])
    {
        return array_merge(['label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ],$option);

    }  
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, $this->getConfiguration("Article", "Entrez votre article..."))
            ->add('prix', MoneyType::class, $this->getConfiguration("Prix", "Entrez le prix..."))
            ->add('description',TextareaType::class, $this->getConfiguration("Description détaillé", "Présentez l'article de manière détaillé..."))
            ->add('image', TextType::class, $this->getConfiguration("Photo de l'article", "URL de l'image de l'article..."))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
