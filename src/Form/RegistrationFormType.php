<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isCompagny', ChoiceType::class, [
                'label' => 'Êtes vous une entreprise ?',
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
            ->add('name', TextType::class, [
                'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => "Nom Prénom / Nom de l'entreprise"]
            ])
            ->add('tel', TextType::class, [
                'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Téléphone']
            ])
            ->add('email', EmailType::class, [
                'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'E-mail']
            ])
            ->add('cp', TextType::class, [
                'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Code Postal (ex : 59000)']
            ])
            ->add('adress', TextType::class, [
                'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Adresse']
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg mb-5',
                    'placeholder' => 'Mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ]
            ])
            ->add('Inscription', SubmitType::class, [
                'attr' => ['type' => 'submit',
                    'class'=> 'btn btn-outline-light btn-lg px-5'
                ],
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
