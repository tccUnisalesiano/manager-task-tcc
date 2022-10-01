<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Funcionario;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class valorfuncionarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idFuncionario', EntityType::class, [
                'class' => Funcionario::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f');
                },
                'choice_label' => 'nomeFuncionario',
                'label' => 'Funcionário: '
            ])
            ->add('valorHora', NumberType::class,
                ['label' => "Valor Horário: "])

            ->add('dataIni', DateType::class,
                ['label' => "Data Incial: ",
                    'html5' => false,
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => ['class' => 'calendario'],
                ])
            ->add('dataFim', DateType::class,
                ['label' => "Data Final: ",
                    'html5' => false,
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => ['class' => 'calendario'],
                ]);
    }
}