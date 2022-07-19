<?php

namespace App\Controller;

use App\Entity\Situacao;
use App\Form\SituacaoType;
use App\Helper\SituacaoFactory;
use App\Repository\SituacaoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe responsável por gerenciar os métodos da situacao
 * @author Guilherme Correia
 */
class SituacaoController extends AbstractController
{
    /**
     * @var SituacaoFactory
     */
    private SituacaoFactory $situacaoFactory;

    /**
     * @param SituacaoFactory $situacaoFactory
     */
    public function __construct(SituacaoFactory $situacaoFactory)
    {
        $this->situacaoFactory = $situacaoFactory;
    }


    // verificar como ira ficar as routes com fk, provavelmente nao será necessario a route para table dependente

    /**
     * @Route("/situacao/cadastrar", name="cadastroSituacao", methods={"POST|GET"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $situacao = $this->situacaoFactory->criarSituacao($return);

        //form
        $form = $this->createForm(SituacaoType::class, $situacao);

        //cadastrar novo
        $form->handleRequest($request);

        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('manutencao'); //add route

        if ($form->isSubmitted() && $form->isValid())
        {
            $situacao = $form->getData();
            $em->persist($situacao);
            $em->flush();

            return $this->redirectToRoute('manutencao');  // add route
        }

        return $this->renderForm('view/admin/cadastrarSituacao.html.twig', [
            'situacao' => $form
        ]);  // add route
    }

    //add route
    /**
     * @Route("/situacao", name="pageSituacao", methods={"GET"})
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Situacao::class);
        $situacaoList = $return->findAll();

        return $this->render('include/admin_situacao.html.twig', [
            'situacao' => $situacaoList
        ]); // add rota
    }

    /**
     * @Route("/situacao/editar{id}", name="editarSituacao")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SituacaoRepository $situacaoRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, SituacaoRepository $situacaoRepository): Response
    {
        $situacao = $situacaoRepository->find($id);
        $form = $this->createForm(SituacaoType::class, $situacao);
        $form->handleRequest($request);

        //para o botão cancelar
        if($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('manutencao');

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($situacao);
            $em->flush();

            return $this->redirectToRoute('manutencao');
        }

        return $this->renderForm('view/admin/cadastrarSituacao.html.twig',[
            'situacao' => $form
        ]); // add route
    }


    /**
     * @Route ("/situacao/excluir/{id}", name="deleteSituacao")
     */
    public function remove(int $id, EntityManagerInterface $em, SituacaoRepository $situacaoRepository): Response
    {
        $situacao = $situacaoRepository->find($id);
        $em->remove($situacao);
        $em->flush();

        return $this->redirectToRoute('manutencao');  // add route
    }

}