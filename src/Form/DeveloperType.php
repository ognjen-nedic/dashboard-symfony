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
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class DeveloperType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('firstName', TextType::class,
                ['attr' => ['placeholder' => 'First name'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            ->add('lastName', TextType::class, 
                ['attr' => ['placeholder' => 'Last name'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            ->add('email', EmailType::class, 
                ['attr' => ['placeholder' => 'Email'],
                'required' => false,
                'empty_data' => '',
                'constraints' => 
                    [new Email(['message' => 'Please enter valid email (e.g. something@universal.com)']),
                    new NotBlank(['message' => 'This field can\'t be empty.'])]])
            /* ->add('password', TextType::class) */
            ->add('phone', TextType::class, 
                ['attr' => ['placeholder' => 'Phone number'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            ->add('street', TextType::class, 
                ['attr' => ['placeholder' => 'Street'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            ->add('city', TextType::class, 
                ['attr' => ['placeholder' => 'City'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            ->add('PTT', IntegerType::class, 
                ['constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            ->add('country', TextType::class, 
                ['attr' => ['placeholder' => 'Country'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            ->add('bankAccount', TextType::class, 
                ['attr' => ['placeholder' => 'Bank account'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
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
