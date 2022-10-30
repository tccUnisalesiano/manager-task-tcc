<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\Projeto;
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
 * Classe responsável por criar o form de Projeto
 * @author Guilherme Correia
 */
class ProjetoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, [
                'label' => "Nome: "
            ])

            ->add('descricao', TextareaType::class, [
                'label' => "Descrição: ",
                'required' => false
            ])

            ->add('situacao', ChoiceType::class,
            ['label' => "Situação: ",
                'choices' => [
                    'Aberta' => 'Aberta',
                    'Fechada' => 'Fechada',
                    'Pausada' => 'Pausada',
                ],
            ])

            ->add('tempoGastoTotal', NumberType::class, [
                'label' => "Tempo Gasto: ",
                'required' => false
                ])

            ->add('cliente_id', EntityType::class, [
                'class' => Cliente::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u');
                },
                'choice_label' => 'cpf_cnpj',
                'label' => 'CPF ou CNPJ do Cliente: '
            ])

            ->add('dataIniPrevisto', DateType::class, [
                'label' => "Data Início Previsto: ",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'required' => false
                ])

            ->add('dataFimPrevisto', DateType::class, [
                'label' => "Data Final Previsto: ",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'required' => false
                ])

            ->add('dataInicial', DateType::class, [
                'label' => "Data Inicial: ",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'required' => false
                ])

            ->add('dataEntregaFinal', DateType::class, [
                'label' => "Data Entrega Final: ",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'required' => false
                ]);
    }
}