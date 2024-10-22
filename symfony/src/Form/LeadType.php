<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LeadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'firstName',
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'lastName',
                'required' => true,
            ])
            ->add('phone', IntegerType::class, [
                'label' => 'phone',
                'required' => true,
            ])
            ->add('email', TextType::class, [
                'label' => 'email',
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Submit'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
