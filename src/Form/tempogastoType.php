<?php

namespace App\Form;

use App\Entity\Funcionario;
use App\Entity\Tarefa;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Classe responsável por gerenciar um novo objeto Tempo Gasto
 * @author Guilherme Correia
 */
class tempogastoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTarefa', EntityType::class,
                [ 'class' => Tarefa::class,
                    'query_builder' => function (EntityRepository $er){
                        return $er->createQueryBuilder('t');
                    },
                    'label' => "Tarefa: ",
                    'choice_label' => 'nome',
                ])
            ->add('idFuncionario', EntityType::class,
                [ 'class' => Funcionario::class,
                    'query_builder' => function (EntityRepository $er){
                        return $er->createQueryBuilder('t');
                    },
                    'label' => "Funcionário: ",
                    'choice_label' => 'nomeFuncionario',

                ])

            ->add('atividade', ChoiceType::class,
                ['label' => "Atividade: ",
                    'choices' => [
                        'Reunião' => 'Reunião',
                        'Desenvolvimento' => 'Desenvolvimento',
                        'Code Review' => 'CodeReview',
                    ],
                ])


            ->add('tempo', NumberType::class,
                ['label' => "Tempo: "])
            ->add('descricao', TextareaType::class,
                ['label' => "Descrição: "])
            ->add('data', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data: ",
                    'html5' => false,
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => ['class' => 'calendario'],
                ])
            ;
    }
}