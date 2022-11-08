<?php

namespace App\Controller;

use App\Entity\Projeto;
use App\Entity\Tarefa;
use App\Repository\ClienteRepository;
use App\Repository\DadosAdminRepository;
use App\Repository\FuncionarioRepository;
use App\Repository\ProjetoRepository;
use App\Repository\TarefaRepository;
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
        $id = $request->request->get('id');
        $response = $projeto->findAllProjetos($id);

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
    public function chartPie(EntityManagerInterface $em, Request $request, ManagerRegistry $registry,
                            ProjetoRepository $projeto,
                            TarefaRepository $tarefa,
                            ClienteRepository $cliente): JsonResponse|NotFoundHttpException
    {
        $id = $request->request->get('id');
        $response = $projeto->findAllChart($id);
        $countTarefa = $tarefa->findAll();
        $countCliente = $cliente->findAllClientes($id);

        if (!empty($response)) {
            return $this->json([
                'success' => true,
                'response' => $response,
                'count' => count($response),
                'tarefas' => count($countTarefa),
                'clientes' => count($countCliente)
            ]);
        } else {
            return $this->json([
                'success' => false,
                'message' => 'Houve um erro ao carregar os dados'
            ]);
        }
    }

}