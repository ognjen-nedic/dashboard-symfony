<?php

namespace App\Form;

use App\Entity\Developer;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeveloperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['attr' => ['placeholder' => 'First name']])
            ->add('lastName', TextType::class, ['attr' => ['placeholder' => 'Last name']])
            ->add('email', EmailType::class, ['attr' => ['placeholder' => 'Email']])
            /* ->add('password', TextType::class) */
            ->add('phone', TextType::class, ['attr' => ['placeholder' => 'Phone number']])
            ->add('street', TextType::class, ['attr' => ['placeholder' => 'Street']])
            ->add('city', TextType::class, ['attr' => ['placeholder' => 'City']])
            ->add('PTT', IntegerType::class)
            ->add('country', TextType::class, ['attr' => ['placeholder' => 'Country']])
            ->add('bankAccount', TextType::class, ['attr' => ['placeholder' => 'Bank account']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'blue-btn']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Developer::class,
        ]);
    }
}
