<?php

namespace App\Controller;

use App\Entity\Projeto;
use App\Entity\Tarefa;
use App\Repository\ClienteRepository;
use App\Repository\DadosAdminRepository;
use App\Repository\FuncionarioRepository;
use App\Repository\ProjetoRepository;
use App\Repository\TarefaRepository;
use App\Repository\UserRepository;
use App\Repository\ValorfuncionarioRepository;
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
        $response = $projeto->findAllChart();

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
        $response = $projeto->findAllChart();
        $countTarefa = $tarefa->findAll();
        $countCliente = $cliente->findAllClientesChart();

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

    /**
     * @Route("/tratamentodados/colaboradores", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param UserRepository $user
     * @return JsonResponse|NotFoundHttpException
     * @throws Exception
     */
    public function chartUsers(EntityManagerInterface $em, Request $request, ManagerRegistry $registry,UserRepository $user): JsonResponse|NotFoundHttpException
    {
        $allUsers = $user->findAll();
        $allInativos = $user->findInativos();
        $allAtivos = $user->findAtivos();

        if (!empty($allUsers)) {
            return $this->json([
                'success' => true,
                'allUsers' => count($allUsers),
                'allInativos' => count($allInativos),
                'allAtivos' => count($allAtivos)
            ]);
        } else {
            return $this->json([
                'success' => false,
                'message' => 'Houve um erro ao carregar os dados'
            ]);
        }
    }

    /**
     * @Route("/tratamentodados/chartValorProjeto", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param ProjetoRepository $projeto
     * @return JsonResponse|NotFoundHttpException
     * @throws Exception
     */
    public function chartValorProjeto(EntityManagerInterface $em, Request $request, ManagerRegistry $registry,
                                      ProjetoRepository $projeto ): JsonResponse|NotFoundHttpException
    {
        $response = $projeto->findValorTarefas();

        $dados = [
            'label' => [],
            'color' => [],
            'value' => []
        ];

        foreach ($response as $dado) {
            $dados['label'][] = trim($dado['nome']);
            $dados['value'][] = $dado['valorProjeto'];
            $dados['color'][] = '#'.dechex(rand(0x00000, 0xFFFFFF));
        }

        if (!empty($response)) {
            return $this->json([
                'success' => true,
                'valor' => $dados,
            ]);
        } else {
            return $this->json([
                'success' => false,
                'message' => 'Houve um erro ao carregar os dados'
            ]);
        }
    }


    /**
     * @Route("/projeto/buscarCountTempoGasto/tempoGastoProjeto", methods={"POST"})
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