<?php

namespace App\Controller;

use App\Entity\Prioridade;
use App\Form\PrioridadeType;
use App\Helper\PrioridadeFactory;
use App\Repository\PrioridadeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe responsável por gerenciar os métodos de prioridade
 * @author Guilherme Correia
 */
class PrioridadeController extends AbstractController
{
    /**
     * @var PrioridadeFactory
     */
    private PrioridadeFactory $prioridadeFactory;

    public function __construct(PrioridadeFactory $prioridadeFactory)
    {
        $this->prioridadeFactory = $prioridadeFactory;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index');
    }

    /**
     * @Route("/prioridade/cadastrar", name="cadastrarPrioridade", methods={"POST|GET"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $prioridade = $this->prioridadeFactory->criarPrioridade($return);

        // form
        $form = $this->createForm(PrioridadeFactory::class, $prioridade);

        //cadastrar novo
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('prioridade');    //implementar route

        //salvar
        if ($form->isSubmitted() && $form->isValid())
        {
            $prioridade = $form->getData();
            $em->persist($prioridade);
            $em->flush();

            return $this->redirectToRoute('prioridade');   //implementar route
        }

        return $this->redirectToRoute('view/admin/cadastrarPrioridade', [
            'prioridade' => $form
        ]);   //implementar route
    }

    /**
     * @Route("/prioridade", name="prioridade", methods={"GET"})
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Prioridade::class);
        $prioridadeList = $return->findAll();

        return $this->render('view/', [
            'prioridade' => $prioridadeList
        ]);  //implementar rota
    }

    /**
     * @Route("/prioridade/editar{id}", name="editarPrioridade")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param PrioridadeRepository $prioridadeRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, PrioridadeRepository $prioridadeRepository): Response
    {
        $prioridade = $prioridadeRepository->find($id);
        $form = $this->createForm(PrioridadeType::class, $prioridade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($prioridade);
            $em->flush();
            return $this->redirectToRoute('prioridade');
        }

        return $this->renderForm('view/', [
            'prioridade' => $form
        ]);  //implementar route
    }

    /**
     * @Route ("/prioridade/excluir/{id}", name="deletePrioridade")
     */
    public function remove(int $id, EntityManagerInterface $em, PrioridadeRepository $prioridadeRepository): Response
    {
        $prioridade = $prioridadeRepository->find($id);
        $em->remove($prioridade);
        $em->flush();

        return $this->redirectToRoute('prioridade');
    }
}