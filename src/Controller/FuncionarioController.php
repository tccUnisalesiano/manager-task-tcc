<?php

namespace App\Controller;

use API\Form\FuncionarioType;
use App\Entity\Funcionario;
use App\Helper\FuncionariosFactory;
<<<<<<< HEAD
use Doctrine\ORM\EntityManager;
=======
use App\Repository\FuncionarioRepository;
>>>>>>> a5999729b4306280b15b3321ec878988fd0a2577
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FuncionarioController extends AbstractController
{

    /**
     *@var FuncionariosFactory
     */
    private FuncionariosFactory $funcionarioFactory;

    /**
     * @param FuncionariosFactory $funcionarioFactory
     *
     */
    public function __construct(
        FuncionariosFactory $funcionarioFactory
    ){
        $this->funcionarioFactory = $funcionarioFactory;
    }

    // rotas para as páginas
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    //rotas de cadastro
    /**
     *@Route ("/funcionario/cadastrar", name="cadastroFuncionario", methods={"POST|GET"})
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $functionary = $this->funcionarioFactory->criarFuncionario($return);

        //formulario de cadastro
        $form = $this->createForm(FuncionarioType::class, $functionary);

        //cadastrar funcionario novo
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $functionary = $form->getData();
            $em->persist($functionary);
            $em->flush();
            return $this->redirectToRoute('funcionario');
        }

        return $this ->renderForm('view/admin/cadastrarFuncionario.html.twig', [
            'funcionario' => $form
        ]);
    }

    /**
     * @Route("/funcionario", name="funcionario", methods={"GET"})
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {

        $return = $doctrine->getRepository(Funcionario::class);
        $functionaryList = $return->findAll();

       // return new JsonResponse($functionaryList);
        return $this->render('view/admin/funcionario.html.twig', [
            'funcionario' =>$functionaryList
        ]);
    }

    /**
     * @Route("/funcionario/editar/{id}", name="editarFuncionario")
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, FuncionarioRepository $funcionarioRepository): Response
    {

        $functionary = $funcionarioRepository->find($id);
        $form = $this->createForm(FuncionarioType::class, $functionary);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //$functionary = $form->getData();
            $em->persist($functionary);
            $em->flush();
            return $this->redirectToRoute('funcionario');

<<<<<<< HEAD
    /**
     * @Route("/funcionario/{id}", methods={"PUT"})
     */
    public function atualiza(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $return = $request->getContent();
        $functionarySend = $this->funcionarioFactory->criarFuncionario($return);

        //print_r($id);

        $functionary = $this->buscaFuncionario($id);
        if (is_null($functionary)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $functionary->nomeFuncionario = $functionarySend->nomeFuncionario;
        $functionary->emailFuncionario = $functionarySend->emailFuncionario;
        $functionary->senha = $functionarySend->senha;
        $functionary->cargaHorariaSemanal = $functionarySend->cargaHorariaSemanal;
        //$functionary->imagemPerfil = $functionarySend->imagemPerfil;

        $entityManager->flush();

        return new JsonResponse($functionary);
    }

    /**
     * @Route("/funcionario/{id}", methods={"DELETE"})
     * @param int $id
     * @param EntityManager $entityManager
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        // print_r($id);

        $functionary = $this->buscaFuncionario($id);
        $entityManager->remove($functionary);
        $entityManager->flush();
=======

        }
        return $this ->renderForm('view/admin/cadastrarFuncionario.html.twig', [
            'funcionario' => $form
        ]);
    }

    /**
     * @Route("/funcionario/excluir/{id}", name="deleteFuncionario")
     */
    public function remove(int $id, EntityManagerInterface $em, FuncionarioRepository $funcionarioRepository): Response
    {
>>>>>>> a5999729b4306280b15b3321ec878988fd0a2577

        $funcionario = $funcionarioRepository->find($id);
        $em->remove($funcionario);
        $em->flush();

<<<<<<< HEAD
    /**
     * @param int $id
     * @return object|null
     */
    public function buscaFuncionario(int $id): ?object
    {
        $return = $this
            ->entityManager
            ->getRepository(Funcionario::class);
        return $return->find($id);
=======
        return $this->redirectToRoute('funcionario');
>>>>>>> a5999729b4306280b15b3321ec878988fd0a2577
    }
}
