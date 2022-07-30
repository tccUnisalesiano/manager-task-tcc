<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('situacao', TextType::class,
                ['label' => "Situação: "])
            ->add('descricao', TextType::class,
                ['label' => "Descricao: "])
            ->add('versao', TextType::class,
                ['label' => "Versão: "])
            ->add('duracao', TextType::class,
                ['label' => "Duração (Semanas): "])
            ->add('dataIni', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data Inicial: ",
                    'html5' => false,
                    'widget' => 'single_text',
                    'attr' => ['class' => 'calendario'],
                ])

            ->add('dataFim', DateType::class,
                ['label' => "Data Final: ",
                    'html5' => false,
                    'widget' => 'single_text',
                    'attr' => ['class' => 'calendario'],
                ]);
    }
}