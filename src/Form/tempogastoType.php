<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('atividade', TextType::class,
                ['label' => "Atividade: "])
            ->add('tempo', TextType::class,
                ['label' => "Tempo: "])
            ->add('descricao', TextType::class,
                ['label' => "Descrição: "])
            ->add('data', DateType::class,   //testar esse dateType, pode nao corresponder com o que queremos
                ['label' => "Data: "])
            ->add('idTarefa', TextType::class,
                ['label' => "Tarefa: "])
            ->add('idValorFuncionario', TextType::class,
                ['label' => "Valor do Funcionario: "]);
    }
}