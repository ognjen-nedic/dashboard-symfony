<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class ClientType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('clientName', TextType::class, 
                ['attr' => ['placeholder' => 'Client name'],
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
            ->add('billing', TextType::class, 
                ['attr' => ['placeholder' => 'Billing'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            ->add('paymentMethod', TextType::class, 
                ['attr' => ['placeholder' => 'Payment Method'],
                'required' => false,
                'empty_data' => '',
                'constraints' => new NotBlank(['message' => 'This field can\'t be empty.'])])
            /* ->add('invoiceData', TextareaType::class, [
                'required'   => false,
                'empty_data' => null,
            ]) */
            ->add('avatar', FileType::class,
                ['mapped' => false, // This prevents Symfony to try to get/set property inside Client Entity
                'required' => false, // This prevents the need to reupload file everytime Client is edited
                'constraints' => 
                    [new File(
                        ['mimeTypes' => 'image/JPEG',
                        'mimeTypesMessage' => 'Avatar file has to be .jpeg format'])]])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'blue-btn']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class
        ]);
    }
}
