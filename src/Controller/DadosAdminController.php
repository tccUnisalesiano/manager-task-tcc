<?php

namespace App\Controller;

use App\Entity\Projeto;
use App\Repository\DadosAdminRepository;
use App\Repository\ProjetoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    public function buscarTodos(ManagerRegistry $registry): Response
    {
        $connection = $registry->getConnection('Projeto');

        $listagem = $connection->fetchAll('SELECT * FROM Projeto');

        return new JsonResponse($listagem);
    }


    /**
     * @Route("/tratamentodados/ajaxAction", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param ManagerRegistry $registry
     * @return void
     */
    public function ajaxAction(EntityManagerInterface $em, Request $request, ManagerRegistry $registry, ProjetoRepository $projeto) {

//        $query = $em->createQuery('SELECT p FROM App\Entity\Projeto p WHERE p.id = 1');
//        $var = [];
//        $var = $projeto->findAllProdutos();
        var_dump($projeto->findAllProdutos());
//        die();
//        $users = $query->getResult();

//        var_dump($users);
        die();

//        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
//            $jsonData = array();
//            $idx = 0;
//            foreach($users as $projeto) {
//                $temp = array(
//                    'id' => $projeto->getId(),
//                    'nomeProjeto' => $projeto->getNomeProjeto(),
//                    'descricao' => $projeto->getDescricao(),
//                    'cliente_id' => $projeto->getClienteId(),
//                    'situacao' => $projeto->getSituacao(),
//                    'data_ini_previsto' => $projeto->getDataIniPrevisto(),
//                    'data_fim_prevista' => $projeto->getDataFimPrevisto(),
//                    'data_entrega_final' => $projeto->getDataEntregaFinal(),
//                    'data_inicial' => $projeto->getDataInicial(),
//                    'tempo_gasto_total' => $projeto->getTempoGastoTotal(),
//                );
//                $jsonData[$idx++] = $temp;
//            }
//            return new JsonResponse($jsonData);
//        } else {
//            return $this->render('view/admin/dados/index.html.twig');
//        }
    }

}