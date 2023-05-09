<?php

namespace App\Form;

use App\Classe\FilterSearch;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('string', TextType::class, [
            "label" => false,
            "required" => false,
            "attr" => [
                "placeholder" => "Votre recherche...",
                "class" => "form-control-sm"
            ]
        ])
        ->add('categories', EntityType::class, [
            "class" => Category::class,
            "label" => false,
            "required" => false,
            "multiple" => true,
            "expanded" => true,
        ])
        ->add("submit", SubmitType::class, [
            "label" => "Filtrer",
            "attr" => [
                "class" => "btn-block rounded rounded-3 w-100 btn-primary pe-1 ps-1"
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterSearch::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }
}