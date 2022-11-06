<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangeImageType;
use App\Form\RegistrationFormType;
use App\Form\UserUpdateType;
use App\Repository\UserRepository;
use App\Security\Authenticator;
use App\Security\EmailVerifier;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier, Security $security)
    {
        $this->emailVerifier = $emailVerifier;
        $this->security = $security;

    }

    /**
     *@Route ("/funcionario/cadastrar", name="cadastroFuncionario", methods={"POST|GET"}, defaults={"title": "Cadastrar Funcionário"})
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher,
                             UserAuthenticatorInterface $userAuthenticator, Authenticator $authenticator,
                             EntityManagerInterface $entityManager, string $title): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('funcionario');    //implementar route

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('dev.guilhermecorreia@hotmail.com', 'Mail Bot'))
                    ->to($user->getEmail())
                    ->subject('Por favor, confirme seu e-mail')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

//        return $this->render('registration/register.html.twig', [
//            'registrationForm' => $form->createView(),
//        ]);

        return $this ->renderForm('view/Cadastros/Funcionario/Form/form.html.twig', [
            'registrationForm' => $form,
            'title' => $title
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_cadastrarUser');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Seu e-mail foi verificado!');

        return $this->redirectToRoute('app_cadastrarUser');
    }

    /**
     * @Route("/funcionario/{id}", name="detalheFuncionario")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserRepository $userRepository
     * @return Response
     */
    public function visualizar(int $id, Request $request, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        return $this->render('view/Cadastros/Funcionario/detalhes/funcionarioDetalhes.html.twig', [
            'registrationForm' => $user
        ]);
    }

    /**
     * @Route("/funcionario", name="funcionario", methods={"GET"})
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(User::class);
        $userList = $return->findAll();

        return $this->render('view/Cadastros/Funcionario/index.html.twig', [
            'registrationForm' =>$userList
        ]);
    }

    /**
     * @Route()
     * @return Response
     */
    public function findUserIndex(): Response
    {
        return $this->render('include/admin_navbar.html.twig', [
            'registrationForm'
        ]);
    }

    /**
     * @Route("/funcionario/editar/{id}", name="editarFuncionario", defaults={"title": "Alterar Funcionário"})
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserRepository $userRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, UserRepository $userRepository, string $title): Response
    {
        $user = $userRepository->find($id);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('funcionario');    //implementar route


        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('funcionario');
        }

        return $this ->renderForm('view/Cadastros/Funcionario/Form/form.html.twig', [
            'registrationForm' => $form,
            'title' => $title
        ]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $em
     * @param UserRepository $userRepository
     * @return Response
     * @Route("/funcionario/excluir/{id}", name="deleteFuncionario")
     */
    public function remove(int $id, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('funcionario');
    }

    /**
     * @Route("/funcionario_perfil", name="perfilUser")
     * @throws Exception
     */
    public function perfilUser(Request $request, EntityManagerInterface $em, UserRepository $userRepository, AuthenticationUtils $authenticationUtils): Response
    {
        $id = $this->security->getUser();
//        $response = $authenticationUtils->getLastUsername();    //email user

//        $id = $userRepository->findUserByName($response);
        $user = $userRepository->find($id);

        $form = $this->createForm(ChangeImageType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist((object)$user);
            $em->flush();
        }

        return $this->render('view/Cadastros/Funcionario/funcionarioPerfil.html.twig', [
            'changeImg' => $form->createView()
        ]);
    }


}
