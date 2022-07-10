<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
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
            ->add('tipoCliente', TextType::class,
                ['label' => "Tipo de Cliente: "])
            ->add('emailCliente', EmailType::class,
                ['label' => "E-mail: "])
            ->add('celularCliente', NumberType::class,
                ['label' => "Nº Celular: "])
            ->add('cpf_cnpj', NumberType::class,
                ['label' => "CPF/CNPJ: "]);
    }

}