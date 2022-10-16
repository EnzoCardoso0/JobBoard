<?php

namespace App\Form;

use App\Entity\Advertissement;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, [
                'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg mb-3',
                    'placeholder' => "Date (ex : 18/05/2001)"]
            ])
            ->add('job', TextType::class, [
            'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg mb-3',
        'placeholder' => "De quel job s'agit il ?"]
            ])
            ->add('job_desc', TextareaType::class, [
                'label' => ' ',
                'attr' => ['class' => 'form-control form-control-lg mb-5',
                    'placeholder' => "Plus d'information ?"]
            ])
            ->add("Ajouter", SubmitType::class, [
                'attr' => ['type' => 'submit',
                    'class'=> 'btn btn-outline-light btn-lg px-5'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Advertissement::class,
        ]);
    }
}
