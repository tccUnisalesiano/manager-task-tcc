<?php
namespace API\Form;


use Symfony\Component\Form\AbstractType;
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
<<<<<<< HEAD
            ->add('nomeFuncionario', TextType::class,
                ['label' => 'Nome:'])
            ->add('emailFuncionario', EmailType::class,
                ['label' => 'E-mail:'])
            ->add('cargaHorariaSemanal', NumberType::class,
                ['label' => 'Carga Horaria Semanal: '])
            ->add('senha', PasswordType::class,
                ['label' => 'Senha:']);
=======
            ->add('nomeFuncionario', TextType::class, ['label' => "Nome Funcionário: "])
            ->add('emailFuncionario', EmailType::class, ['label' => "E-mail Funcionário: "])
            ->add('cargaHorariaSemanal', NumberType::class, ['label' => "Carga Horária Semanal: "])
            ->add('senha', PasswordType::class, ['label' => "Senha: "]);
>>>>>>> d1873a0752e9b837942f31366f12340fa4266e96
    }
}