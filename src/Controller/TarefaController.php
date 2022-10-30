<?php

namespace App\Controller;

use App\Entity\Tarefa;
use App\Form\TarefaType;
use App\Helper\TarefaFactory;
use App\Repository\TarefaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe responsável por gerenciar os metodos de Tarefa
 * @author Guilherme Correia
 */
class TarefaController extends AbstractController
{
    private TarefaFactory $tarefaFactory;

    /**
     * @param TarefaFactory $tarefaFactory
     */
    public function __construct(TarefaFactory $tarefaFactory)
    {
        $this->tarefaFactory = $tarefaFactory;
    }

    /**
     * @Route ("/tarefa/cadastrar", name="cadastroTarefa", methods={"POST|GET"}, defaults={"title": "Cadastrar Tarefa"})
     */
    public function novo(Request $request, EntityManagerInterface $em, string $title): Response
    {
        $return = $request->getContent();
        $tarefa = $this->tarefaFactory->criarTarefa($return);

        // form
        $form = $this->createForm(TarefaType::class, $tarefa);

        //cadastrar novo
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('tarefa');    //implementar route

        //salvar
        if ($form->isSubmitted() && $form->isValid())
        {
            $tarefa = $form->getData();
            $em->persist($tarefa);
            $em->flush();
            return $this->redirectToRoute('tarefa');   //implementar route
        }

        return $this->renderForm('view/Cadastros/Tarefa/form/form.html.twig', [
            'tarefa' => $form, 'title' => $title
        ]);
    }

    /**
     * @Route("/tarefa", name="tarefa", methods={"GET"})
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Tarefa::class);
        $tarefaList = $return->findAll();

        return $this->render('view/Cadastros/Tarefa/index.html.twig', [
            'tarefa' => $tarefaList
        ]);
    }

    /**
     * @Route("/tarefa/editar/{id}", name="editarTarefa", defaults={"title": "Alterar Tarefa"})
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param TarefaRepository $tarefaRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, TarefaRepository $tarefaRepository, string $title): Response
    {
        $tarefa = $tarefaRepository->find($id);
        $form = $this->createForm(TarefaType::class, $tarefa);
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('tarefa');    //implementar route

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($tarefa);
            $em->flush();
            return $this->redirectToRoute('tarefa');
        }

        return $this->renderForm('view/Cadastros/Tarefa/form/form.html.twig', [
            'tarefa' => $form, 'title' => $title
        ]);
    }

    /**
     * @Route ("/tarefa/excluir/{id}", name="deleteTarefa")
     */
    public function remove(int $id, EntityManagerInterface $em, TarefaRepository $tarefaRepository): Response
    {
        $tarefa = $tarefaRepository->find($id);
        $em->remove($tarefa);
        $em->flush();

        return $this->redirectToRoute('tarefa');
    }

    /**
     * @Route("/tarefa/{id}", name="detalheTarefa")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param TarefaRepository $tarefaRepository
     * @return Response
     */
    public function visualizar(int $id, Request $request, EntityManagerInterface $em, TarefaRepository $tarefaRepository): Response
    {
        $tarefa = $tarefaRepository->find($id);

        return $this->render('view/Cadastros/Tarefa/detalhes/tarefaDetalhes.html.twig', [
            'tarefa' => $tarefa
        ]);
    }
}