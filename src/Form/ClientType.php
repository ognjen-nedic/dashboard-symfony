<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clientName', TextType::class, ['attr' => ['placeholder' => 'Client name']])
            ->add('email', EmailType::class, ['attr' => ['placeholder' => 'Email']])
            ->add('billing', TextType::class, ['attr' => ['placeholder' => 'Billing']])
            ->add('paymentMethod', TextType::class, ['attr' => ['placeholder' => 'Payment Method']])
            /* ->add('invoiceData', TextareaType::class, [
                'required'   => false,
                'empty_data' => null,
            ]) */
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'blue-btn']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
            /* 'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'task_item', */
        ]);
    }
}
