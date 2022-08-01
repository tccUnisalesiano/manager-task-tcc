<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Classe responsável por gerenciar um novo objeto Sprint
 * @author Guilherme Correia
 */
class SprintType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('situacao', ChoiceType::class,
                ['label' => "Situação: ",
                    'choices' => [
                        'Aberta' => 'Aberta',
                        'Fechada' => 'Fechada',
                        'Pausada' => 'Pausada',
                    ],
                ])

            ->add('descricao', TextType::class,
                ['label' => "Descricao: "])

            ->add('versao', TextType::class,
                ['label' => "Versão: "])

            ->add('duracao', NumberType::class,
                ['label' => "Duração (Semanas): "])

            ->add('dataIni', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data Inicial: ",
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