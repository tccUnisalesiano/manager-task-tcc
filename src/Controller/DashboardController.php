<?php

namespace App\Controller;

use App\Repository\ClienteRepository;
use App\Repository\ProjetoRepository;
use App\Repository\TarefaRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('view/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    /**
     * @Route("/dashboard/projetos", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param ProjetoRepository $projeto
     * @return JsonResponse|NotFoundHttpException
     * @throws Exception
     */
    public function projetos(EntityManagerInterface $em, Request $request, ManagerRegistry $registry, ProjetoRepository $projeto): JsonResponse|NotFoundHttpException
    {

        $response = $projeto->findAllProjetos();

        if(!$response) return new NotFoundHttpException();

        return $this->json([
            'success' => true,
            'response' => count($response)
        ]);
    }

    /**
     * @Route("/dashboard/projetosAberto", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param ProjetoRepository $projeto
     * @return JsonResponse|NotFoundHttpException
     * @throws Exception
     */
    public function projetosAberto(EntityManagerInterface $em, Request $request, ManagerRegistry $registry, ProjetoRepository $projeto): JsonResponse|NotFoundHttpException
    {

        $response = $projeto->findAllProjetosAberto();

        if(!$response) return new NotFoundHttpException();

        return $this->json([
            'success' => true,
            'response' => count($response)
        ]);
    }



    /**
     * @Route("/dashboard/tarefas", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param TarefaRepository $tarefa
     * @return JsonResponse|NotFoundHttpException
     */
    public function tarefas(EntityManagerInterface $em, Request $request, ManagerRegistry $registry, TarefaRepository $tarefa): JsonResponse|NotFoundHttpException
    {

        $response = $tarefa->findAll();

        if(!$response) return new NotFoundHttpException();

        return $this->json([
            'success' => true,
            'response' => count($response)
        ]);
    }

    /**
     * @Route("/dashboard/clientes", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param ClienteRepository $cliente
     * @return JsonResponse|NotFoundHttpException
     */
    public function clientes(EntityManagerInterface $em, Request $request, ManagerRegistry $registry, ClienteRepository $cliente): JsonResponse|NotFoundHttpException
    {

        $response = $cliente->findAll();

        if(!$response) return new NotFoundHttpException();

        return $this->json([
            'success' => true,
            'response' => count($response)
        ]);
    }
}
