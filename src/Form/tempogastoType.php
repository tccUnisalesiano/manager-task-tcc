<?php

namespace App\Form;

use App\Entity\Tarefa;
use App\Entity\User;
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
            ->add('idUser', EntityType::class,
                [ 'class' => User::class,
                    'query_builder' => function (EntityRepository $er){
                        return $er->createQueryBuilder('u');
                    },
                    'label' => "Funcionário: ",
                    'choice_label' => 'nome',

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

            ->add('descricao', TextareaType::class, [
                'label' => "Descrição: ",
                'required'=>false
            ])

            ->add('data', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data: ",
                    'widget' => 'single_text',
                    'attr' => ['class' => 'js-datepicker'],
                ])
            ;
    }
}