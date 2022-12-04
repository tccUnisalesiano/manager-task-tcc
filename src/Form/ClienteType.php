<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Classe responsável por criar o form de cliente
 * @author Guilherme Correia
 */
class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomeCliente', TextType::class,
                ['label' => "Nome Completo: "])
            ->add('cpf_cnpj', TextType::class,
                ['row_attr' => ['label' => "CPF/CNPJ ", 'id' => "cpfcnpj"], ])
            ->add('emailCliente', EmailType::class,
                ['row_attr' => ['label' => "E-mail: ", 'id' => "mailCliente"], ])
            ->add('celularCliente', TextType::class,
                [ 'row_attr' => ['label' => "Nº Celular: ", 'id' => "celular" ], ])
            ->add('tipoCliente', ChoiceType::class,
                ['label' => "Tipo Cliente: ",
                    'choices' => [
                        'Pessoa Física' => 'Pessoa Física',
                        'Pessoa Jurídica' => 'Pessoa Jurídica',
                    ],
                ]);
    }
}