<?php

namespace App\Controller;

use App\Entity\Funcionario;
use App\Helper\FuncionariosFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FuncionarioController extends AbstractController
{
    /**
     *@var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     *@var FuncionariosFactory
     */
    private FuncionariosFactory $funcionarioFactory;

    /**
     * @param FuncionariosFactory $funcionarioFactory
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FuncionariosFactory $funcionarioFactory
    ){
        $this->entityManager = $entityManager;
        $this->funcionarioFactory = $funcionarioFactory;
    }

    /**
     *@Route ("/funcionario", methods={"POST"})
     */
    public function novo(Request $request): Response
    {
        $return = $request->getContent();
        $functionary = $this->funcionarioFactory->criarFuncionario($return);

        $this->entityManager->persist($functionary);
        $this->entityManager->flush();

        return new JsonResponse($functionary);
    }

    /**
     * @Route("/funcionario", methods={"GET"})
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Funcionario::class);
        $functionaryList = $return->findAll();

        return new JsonResponse($functionaryList);
    }

    /**
     * @Route("/funcionario/{id}", methods={"GET"})
     */
    public function buscarUm(int $id): Response
    {
        $return = $this
            ->entityManager
            ->getRepository(Funcionario::class);
        $functionary = $return->find($id);
        $return = is_null($functionary) ? Response::HTTP_NO_CONTENT : 200;

        return new JsonResponse($functionary, $return);
    }

    /**
     * @Route("/funcionario/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $return = $request->getContent();
        $functionarySend = $this->funcionarioFactory->criarFuncionario($return);

        $functionary = $this->buscaFuncionario($id);
        if (is_null($functionary)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $functionary->nomeFuncionario = $functionarySend->nomeFuncionario;
        $functionary->senha = $functionarySend->senha;
        $functionary->emailFuncionario = $functionarySend->emailFuncionario;
        $functionary->cargaHorariaSemanal = $functionarySend->cargaHorariaSemanal;
        //$functionary->imagemPerfil = $functionarySend->imagemPerfil;

        $this->entityManager->flush();

        return new JsonResponse($functionary);
    }

    /**
     * @Route("/funcionario/{id}", methods={"DELETE"})
     */
    public function remove(int $id): Response
    {
        $functionary = $this->buscaFuncionario($id);
        $this->entityManager->remove($functionary);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function buscaFuncionario(int $id ): object|null
    {
        $return = $this
            ->entityManager
            ->getRepository(Funcionario::class);
        $functionaryList = $return->find($id);

        return new JsonResponse($functionaryList);
    }
}
