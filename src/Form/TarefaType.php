<?php

namespace App\Form;

use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
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
            ->add('idProjeto', TextType::class,
                ['label' => "Projeto: "])
            ->add('prioridade', TextType::class,
                ['label' => "Prioridade: "])
            ->add('situacao', TextType::class,
                ['label' => "Situação: "])
            ->add('nomeTarefa', TextType::class,
                ['label' => "Nome da tarefa: "])
            ->add('nome', TextType::class,
                ['label' => "Nome: "])
            ->add('descricao', TextType::class,
                ['label' => "Descrição: "])
            ->add('tempoEstimado', TextType::class,
                ['label' => "Tempo Estimado: "])
            ->add('dataIni', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data Inicial: "])
            ->add('dataFim', DateType::class,
                ['label' => "Data Final: "])
            ->add('documentacao', TextType::class,
                ['label' => "Documentação: "])
            ->add('tipoTarefa', TextType::class,
                ['label' => "Tipo de Tarefa: "])
            ->add('idFuncionario', TextType::class,
                ['label' => "Funcionario: "]);
    }
}