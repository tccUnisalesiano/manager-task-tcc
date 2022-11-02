<?php

namespace App\Controller;

use App\Entity\Projeto;
use App\Repository\DadosAdminRepository;
use App\Repository\FuncionarioRepository;
use App\Repository\ProjetoRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DadosAdminController extends AbstractController
{

    #[Route('/tratamentodados', name: 'app_dados')]
    public function index()
    {
        return $this->render('view/admin/dados/index.html.twig', [
            'controller_name' => 'DadosAdminController',
        ]);
    }

    /**
     * @Route("/tratamentodados/projetos", methods={"POST"})
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

    /**
     * @Route("/tratamentodados/chartgeral", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param ProjetoRepository $projeto
     * @return JsonResponse|NotFoundHttpException
     * @throws Exception
     */
    public function funcionarios(EntityManagerInterface $em, Request $request, ManagerRegistry $registry,
                            ProjetoRepository $projeto): JsonResponse|NotFoundHttpException
    {
        $response = $projeto->findAllChart();

        if (!empty($response)) {
            return $this->json([
                'success' => true,
                'response' => $response,
                'count' => count($response)
            ]);
        } else {
            return $this->json([
                'success' => false,
                'message' => 'Houve um erro ao carregar os dados'
            ]);
        }
    }

}