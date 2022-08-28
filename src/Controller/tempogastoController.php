<?php

namespace App\Controller;

use App\Entity\Tempogasto;
use App\Form\tempogastoType;
use App\Helper\tempogastoFactory;
use App\Repository\TempogastoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe responsável por gerenciar os métodos de Tempo Gasto
 * @author Guilherme Correia
 */
class tempogastoController extends AbstractController
{
    private tempogastoFactory $tempogastoFactory;

    /**
     * @param tempogastoFactory $tempogastoFactory
     */
    public function __construct(tempogastoFactory $tempogastoFactory)
    {
        $this->tempogastoFactory = $tempogastoFactory;
    }

    /**
     * @Route ("/tempogasto/cadastrar", name="cadastroTempogasto", methods={"POST|GET"})
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $tempogasto = $this->tempogastoFactory->criarTempogasto($return);

        // form
        $form = $this->createForm(tempogastoType::class, $tempogasto);

        //cadastrar novo
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('tarefa');    //implementar route

        //salvar
        if ($form->isSubmitted() && $form->isValid())
        {
            $tempogasto = $form->getData();
            $em->persist($tempogasto);
            $em->flush();
            return $this->redirectToRoute('tarefa');   //implementar route
        }

        return $this->renderForm('view/user/tempoGastoCadastrar.html.twig', [
            'tempogasto' => $form
        ]);
    }

    /**
     * @Route("/tempogasto", name="tempogasto", methods={"GET"})
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Tempogasto::class);
        $tempogastoList = $return->findFuncionarioId();

        return $this->render('include/user_tempoGasto.html.twig', [
            'tempogasto' => $tempogastoList
        ]);  //implementar rota
    }

    /**
     * @Route("/tempogasto/editar/{id}", name="editartempogasto")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param TempogastoRepository $tempogastoRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, TempogastoRepository $tempogastoRepository): Response
    {
        $tempogasto = $tempogastoRepository->find($id);
        $form = $this->createForm(tempogastoType::class, $tempogasto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($tempogasto);
            $em->flush();
            return $this->redirectToRoute('tarefa');
        }

        return $this->renderForm('view/user/tempoGastoCadastrar.html.twig', [
            'tempogasto' => $form
        ]);  //implementar route
    }

    /**
     * @Route ("/tempogasto/excluir/{id}", name="deleteTempogasto")
     */
    public function remove(int $id, EntityManagerInterface $em, TempogastoRepository $tempogastoRepository): Response
    {
        $tempogasto = $tempogastoRepository->find($id);
        $em->remove($tempogasto);
        $em->flush();

        return $this->redirectToRoute('tarefa');
    }
}