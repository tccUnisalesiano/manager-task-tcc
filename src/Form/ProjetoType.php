<?php

namespace App\Form;

use App\Entity\Projeto;
use Symfony\Component\Form\AbstractType;
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
            ->add('nomeProjeto', TextType::class,
                ['label' => "Nome do Projeto: "])
            ->add('descricao', TextType::class,
                ['label' => "Descrição do Projeto: "]);
    }
}