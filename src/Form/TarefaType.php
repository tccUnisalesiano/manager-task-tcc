<?php

namespace App\Form;

use App\Entity\Funcionario;
use App\Entity\Projeto;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Classe responsável por gerenciar um novo objeto Tarefa
 * @author Guilherme Correia
 */
class TarefaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idProjeto', EntityType::class,
                [ 'class' => Projeto::class,
                    'query_builder' => function (EntityRepository $er){
                        return $er->createQueryBuilder('p');
                    },
                    'label' => "Projeto: ",
                    'choice_label' => 'nome',
                ])

            ->add('idFuncionario', EntityType::class,
                [ 'class' => Funcionario::class,
                    'query_builder' => function (EntityRepository $er){
                        return $er->createQueryBuilder('f');
                    },
                    'label' => "Atribuído para: ",
                    'choice_label' => 'nomeFuncionario',
                ])

            ->add('prioridade', ChoiceType::class,
                ['label' => "Prioridade: ",
                    'choices' => [
                        'Urgente' => 'Urgente',
                        'Alta' => 'Alta',
                        'Normal' => 'Normal',
                        'Baixa' => 'Baixa',
                    ],
                ])

            ->add('situacao', ChoiceType::class,
                ['label' => "Situação: ",
                    'choices' => [
                        'Aberta' => 'Aberta',
                        'Fechada' => 'Fechada',
                        'Pausada' => 'Pausada',
                    ],
                ])

            ->add('tipoTarefa', ChoiceType::class,
                ['label' => "Tipo Tarefa: ",
                    'choices' => [
                        'Defeito' => 'Defeito',
                        'Funcionalidade' => 'Funcionalidade',

                    ],
                ])
            ->add('nome', TextType::class,
                ['label' => "Nome da Tarefa: "])
            ->add('descricao', TextareaType::class,
                ['label' => "Descrição: "])
            ->add('tempoEstimado', NumberType::class,
                ['label' => "Tempo Estimado: "])
            ->add('tempoGasto', NumberType::class,
                ['label' => "Tempo Gasto: "])
            ->add('dataIni', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data Inicial: ",
                    'widget' => 'single_text',
                    'attr' => ['class' => 'js-datepicker'],
                ])
            ->add('dataFim', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data Final: ",
                    'widget' => 'single_text',
                    'attr' => ['class' => 'js-datepicker'],
                ])
//            ->add('documentacao', TextType::class,
//                ['label' => "Documentação: "])
            ->add('status', ChoiceType::class,
                ['label' => "Status: ",
                    'choices' => [
                        'Planejamento' => 'Planejamento',
                        'Desenvolvimento' => 'Desenvolvimento',
                        'Pausada' => 'Pausada',
                        'Entrega' => 'Entrega'
                    ],
                ])
            ->add('porcentagem', ChoiceType::class,
                ['label' => "Porcentagem: ",
                    'choices' => [
                        0 => 0,
                        10 => 10,
                        20 => 20,
                        30 => 30,
                        40 => 40,
                        50 => 50,
                        60 => 60,
                        70 => 70,
                        80 => 80,
                        90 => 90,
                        100 =>100,
                    ],
                ])
            ;
    }
}