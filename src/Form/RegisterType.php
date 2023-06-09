<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => new Length(60, 3),
                'label' => 'Votre email',
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre email']
            ])
            ->add('firstname', TextType::class, [
                'constraints' => new Length(30, 3),
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre prénom']
            ])
            ->add('lastname', TextType::class, [
                'constraints' => new Length(30, 3),
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre nom']
            ])
            ->add('password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'invalid_message'=> 'Le mot de passe et la confirmation doivent correspondre !',
                'label'=> 'Votre mot de passe',
                'first_options' => ['label'=> 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Veuillez saisir votre mot de passe']],
                'second_options' => ['label'=> 'Confirmer votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de répéter votre mot de passe']],
                'required'=> true
            ])
            // ->add('password_confirme', PasswordType::class, [
            //     'label' => "Confirmez votre mot de passe",
            //     'mapped' => false,
            //     'attr' => [
            //         'placeholder' => 'Confirmez votre mot de passe'
            //     ]
            // ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
