<?php

namespace App\Controller;

use App\Entity\Projeto;
use App\Form\ProjetoType;
use App\Helper\ProjetoFactory;
use App\Repository\ProjetoRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/projeto/cadastrar", name="cadastroProjeto", defaults={"title": "Cadastrar Projeto"})
     */
    public function novo(Request $request, EntityManagerInterface $em, string $title): Response
    {
        $return = $request->getContent();
        $projeto = $this->projetoFactory->criarProjeto($return);

        $form = $this->createForm(ProjetoType::class, $projeto);

        $form->handleRequest($request);

        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('projeto');

        if ($form->isSubmitted() && $form->isValid())
        {
            $projeto = $form->getData();
            $em->persist($projeto);
            $em->flush();
            return $this->redirectToRoute('projeto');
        }

        return $this->renderForm('view/Cadastros/Projeto/form/form.html.twig', [
            'projeto' => $form, 'title' => $title
        ]);
    }

    /**
     * @Route("/projeto", name="projeto", methods={"GET"})
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Projeto::class);
        $projetoList = $return->findAll();

        return $this->render('view/Cadastros/Projeto/index.html.twig', [
            'projeto' => $projetoList
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ProjetoRepository $projetoRepository
     * @return Response
     * @Route("/projeto/editar/{id}", name="editarProjeto", defaults={"title": "Alterar Projeto"})
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, ProjetoRepository $projetoRepository, string $title): Response
    {
        $projeto = $projetoRepository->find($id);
        $form = $this->createForm(ProjetoType::class, $projeto);
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('projeto');    //implementar route

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($projeto);
            $em->flush();
            return $this->redirectToRoute('projeto');
        }

        return $this->renderForm('view/Cadastros/Projeto/form/form.html.twig', [
            'projeto' => $form, 'title' => $title, 'idProjeto' => $id
        ]);

    }

    /**
     * @param int $id
     * @param EntityManagerInterface $em
     * @param ProjetoRepository $projetoRepository
     * @return Response
     * @Route("/projeto/excluir/{id}", name="deleteProjeto")
     */
    public function remove(int $id, EntityManagerInterface $em, ProjetoRepository $projetoRepository): Response
    {
        $projeto = $projetoRepository->find($id);
        $em->remove($projeto);
        $em->flush();

        return $this->redirectToRoute('projeto');
    }


    /**
     * @Route("/projeto/{id}", name="detalheProjeto")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ProjetoRepository $projetoRepository
     * @return Response
     */
    public function visualizar(int $id, Request $request, EntityManagerInterface $em, ProjetoRepository $projetoRepository): Response
    {
        $projeto = $projetoRepository->find($id);

        return $this->render('view/Cadastros/Projeto/detalhes/projetoDetalhes.html.twig', [
            'projeto' => $projeto
        ]);
    }

    /**
     * @Route("/projeto/editar/buscarCountTempoGasto/tempoGastoProjeto", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param ProjetoRepository $projeto
     * @return JsonResponse|NotFoundHttpException
     * @throws Exception
     */
    public function tempoGastoProjeto(EntityManagerInterface $em, Request $request, ManagerRegistry $registry, ProjetoRepository $projeto): JsonResponse|NotFoundHttpException
    {
        $id = $request->get('id');
        $response = $projeto->countTempoGastoProjeto($id);

        if (!empty($response)) {
            return $this->json([
                'success' => true,
                'response' => $response
            ]);
        } else {
            return $this->json([
                'success' => false,
                'message' => 'Não há dados a serem mostrados no momento',
                'response' => false
            ]);
        }
    }
}