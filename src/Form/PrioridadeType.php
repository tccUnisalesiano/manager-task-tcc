<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Classe responsável por criar o form de prioridades
 * @author Guilherme Correia
 */
class PrioridadeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomePrioridade', TextType::class,
            ['label' => "Prioridade: "])
            ->add('cor', ColorType::class,
            ['label' => "Grau de Prioridade: "]);
    }
}