<?php

namespace App\Form;

use App\Entity\Developer;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
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
            ->add('avatar', FileType::class,
            ['mapped' => false, // This prevents Symfony to try to get/set property inside Client Entity
            'required' => false, // This prevents the need to reupload file everytime Client is edited
            'constraints' => 
                [new File(
                    ['mimeTypes' => 'image/JPEG',
                    'mimeTypesMessage' => 'Avatar file has to be .jpeg format'])]])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false, // This prevents Symfony to try to get/set property inside Client Entity
                'attr' => ['autocomplete' => 'new-password','placeholder' => 'Password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
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
