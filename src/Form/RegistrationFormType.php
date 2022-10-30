<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Senha: ',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Insira a senha',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'A senha não pode ter menos que {{ limit }} caracters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nome', TextType::class,
                ['label' => "Nome Funcionário: "])

            ->add('cargaHorariaSemanal', NumberType::class,
                ['label' => "Carga Horária Semanal: "])

            ->add('isAtivo', ChoiceType::class,
                ['label' => "Status Funcionário: ",
                    'choices' =>[
                        'Ativo' => True,
                        'Desativo' => False,
                    ],
                ])
            ->add('roles', ChoiceType::class, [
                'label' => "Pessoa: ",
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                    'choices' => [
                        'Usuário' => 'ROLE_USER',
                        'Administrador'=> 'ROLE_ADMIN'
                    ],
            ])

            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label' => 'Imagem: ',
            ]);

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsArray) {
                    // transform the array to a string
                    return implode(', ', $tagsAsArray);
                },
                function ($tagsAsString) {
                    // transform the string back to an array
                    return explode(', ', $tagsAsString);
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
