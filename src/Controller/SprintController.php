<?php

namespace App\Controller;

use App\Entity\Sprint;
use App\Form\SprintType;
use App\Helper\SprintFactory;
use App\Repository\SprintRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe responsável por gerenciar os metodos de Sprint
 * @author Guilherme Correia
 */
class SprintController extends AbstractController
{
    private SprintFactory $sprintFactory;

    /**
     * @param SprintFactory $sprintFactory
     */
    public function __construct(SprintFactory $sprintFactory)
    {
        $this->sprintFactory = $sprintFactory;
    }

    /**
     * @Route ("/sprint/cadastrar", name="cadastroSprint", methods={"POST|GET"})
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $sprint = $this->sprintFactory->criarSprint($return);

        // form
        $form = $this->createForm(SprintType::class, $sprint);

        //cadastrar novo
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('sprint');    //implementar route

        //salvar
        if ($form->isSubmitted() && $form->isValid())
        {
            $sprint = $form->getData();
            $em->persist($sprint);
            $em->flush();
            return $this->redirectToRoute('sprint');   //implementar route
        }

        return $this->renderForm('view/user/sprintCadastrar.html.twig', [
            'sprint' => $form
        ]);
    }

    /**
     * @Route("/sprint", name="sprint", methods={"GET"})
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Sprint::class);
        $sprintList = $return->findAll();

        return $this->render('view/user/sprint.html.twig', [
            'sprint' => $sprintList
        ]);  //implementar rota
    }

    /**
     * @Route("/sprint/editar/{id}", name="editarSprint")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SprintRepository $sprintRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, SprintRepository $sprintRepository): Response
    {
        $sprint = $sprintRepository->find($id);
        $form = $this->createForm(SprintType::class, $sprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($sprint);
            $em->flush();
            return $this->redirectToRoute('sprint');
        }

        return $this->renderForm('view/user/sprintCadastrar.html.twig', [
            'sprint' => $form
        ]);  //implementar route
    }

    /**
     * @Route ("/sprint/excluir/{id}", name="deleteSprint")
     */
    public function remove(int $id, EntityManagerInterface $em, SprintRepository $sprintRepository): Response
    {
        $sprint = $sprintRepository->find($id);
        $em->remove($sprint);
        $em->flush();

        return $this->redirectToRoute('sprint');
    }

    /**
     * @Route("/sprint/{id}", name="detalheSprint")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SprintRepository $sprintRepository
     * @return Response
     */
    public function visualizar(int $id, Request $request, EntityManagerInterface $em, SprintRepository $sprintRepository): Response
    {
        $sprint = $sprintRepository->find($id);

        return $this->render('view/user/clienteDetalhes.html.twig', [
            'sprint' => $sprint
        ]);
    }


}