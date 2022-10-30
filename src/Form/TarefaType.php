<?php

namespace App\Form;

use App\Entity\Projeto;
use App\Entity\User;
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

            ->add('idUser', EntityType::class,
                [ 'class' => User::class,
                    'query_builder' => function (EntityRepository $er){
                        return $er->createQueryBuilder('f');
                    },
                    'label' => "Atribuído para: ",
                    'choice_label' => 'nome',
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

            ->add('descricao', TextareaType::class, [
                'label' => "Descrição: ",
                'required'=>false
            ])

            ->add('tempoEstimado', NumberType::class, [
                'label' => "Tempo Estimado: ",
                'required'=>false
            ])

            ->add('tempoGasto', NumberType::class, [
                'label' => "Tempo Gasto: ",
                'required'=>false
                ])

            ->add('dataIni', DateType::class, [
                    'label' => "Data Inicial: ",
                    'widget' => 'single_text',
                    'attr' => ['class' => 'js-datepicker'],
                    'required' => false
                ])
            ->add('dataFim', DateType::class,[
                    'label' => "Data Final: ",
                    'widget' => 'single_text',
                    'attr' => ['class' => 'js-datepicker'],
                    'required' => false
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