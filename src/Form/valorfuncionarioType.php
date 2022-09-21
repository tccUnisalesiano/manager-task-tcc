<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class valorfuncionarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idFuncionario', TextType::class,
                ['label' => "Codigo Funcionario: "])
            ->add('valorHora', TextType::class,
                ['label' => "Valor Horário: "])
            ->add('dataIni', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data Inicial: "])
            ->add('dataFim', DateType::class,
                ['label' => "Data Final: "]);
    }
}