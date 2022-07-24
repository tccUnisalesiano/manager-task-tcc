<?php

namespace App\Controller;

use App\Entity\Projeto;
use App\Form\ProjetoType;
use App\Helper\ProjetoFactory;
use App\Repository\ProjetoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Classe responsável por gerenciar os metodos de cliente
 * @author Guilherme Correia
 */
class ProjetoController extends AbstractController
{
    private ProjetoFactory $projetoFactory;

    /**
     * @param ProjetoFactory $projetoFactory
     */
    public function __construct(ProjetoFactory $projetoFactory)
    {
        $this->projetoFactory = $projetoFactory;
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $projeto = $this->projetoFactory->criarProjeto($return);

        $form = $this->createForm(ProjetoType::class, $projeto);

        $form->handleRequest($request);

        if ($request->get('cancel') == 'Cancel')  return $this->redirectToRoute('projeto');

        if ($form->isSubmitted() && $form->isValid())
        {
            $projeto = $form->getData();
            $em->persist($projeto);
            $em->flush();
            return $this->redirectToRoute('projeto');
        }

        return $this->renderForm('view/user/projetoCadastrar.html.twig', ['projeto' => $form ]);
    }

    /**
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Projeto::class);
        $projetoList = $return->findAll();

        return $this->render('inserir route', ['projeto' => $projetoList]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ProjetoRepository $projetoRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, ProjetoRepository $projetoRepository): Response
    {
        $projeto = $projetoRepository->find($id);
        $form = $this->createForm(ProjetoType::class, $projeto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($projeto);
            $em->flush();
            return $this->redirectToRoute('projeto');
        }

        return $this->renderForm('view/user/.html.twig', [
            'projeto' => $form
        ]);  //implementar route
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $em
     * @param ProjetoRepository $projetoRepository
     * @return Response
     */
    public function remove(int $id, EntityManagerInterface $em, ProjetoRepository $projetoRepository): Response
    {
        $projeto = $projetoRepository->find($id);
        $em->remove($projeto);
        $em->flush();

        return $this->redirectToRoute('projeto');
    }
}