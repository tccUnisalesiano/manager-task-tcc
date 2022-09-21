<?php
namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use function Sodium\add;

class FuncionarioType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomeFuncionario', TextType::class,
                ['label' => "Nome Funcionário: "])
            ->add('emailFuncionario', EmailType::class,
                ['label' => "E-mail Funcionário: "])
            ->add('cargaHorariaSemanal', NumberType::class,
                ['label' => "Carga Horária Semanal: "])
            ->add('isAdmin', ChoiceType::class,
                ['label' => "Administrador: ",
                    'choices' =>[
                        'Não' => False,
                        'Sim' => True,
                    ],
                ])
            ->add('isAtivo', ChoiceType::class,
                ['label' => "Funcionario está ativo?: ",
                    'choices' =>[
                        'Não' => False,
                        'Sim' => True,
                    ],
                ])
            ->add('senha', TextType::class,
                ['label' => "Senha: "]);
    }
}