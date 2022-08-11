<?php

namespace App\Controller;

use App\Entity\Valorfuncionario;
use App\Form\valorfuncionarioType;
use App\Helper\valorfuncionarioFactory;
use App\Repository\ValorfuncionarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe responsável por gerenciar os métodos de Valor do Funcionario
 * @author Guilherme Correia
 */
class valorfuncionarioController extends AbstractController
{
    private valorfuncionarioFactory $valorfuncionarioFactory;

    /**
     * @param valorfuncionarioFactory $valorfuncionarioFactory
     */
    public function __construct(valorfuncionarioFactory $valorfuncionarioFactory)
    {
        $this->valorfuncionarioFactory = $valorfuncionarioFactory;
    }

    /**
     * @Route ("/valorfuncionario/cadastrar", name="cadastroValorFuncionario", methods={"POST|GET"})
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $vFuncionario = $this->valorfuncionarioFactory->criarVfuncionario($return);

        // form
        $form = $this->createForm(valorfuncionarioType::class, $vFuncionario);

        //cadastrar novo
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('funcionario');    //implementar route

        //salvar
        if ($form->isSubmitted() && $form->isValid())
        {
            $vFuncionario = $form->getData();
            $em->persist($vFuncionario);
            $em->flush();
            return $this->redirectToRoute('funcionario');   //implementar route
        }

        return $this->renderForm('view/admin/valorFuncionarioCadastrar.html.twig', [
            'valorfuncionario' => $form
        ]);
    }

    /**
     * @Route("/valorfuncionario", name="valorfuncionario", methods={"GET"})
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Valorfuncionario::class);
        $vFuncionarioList = $return->findAll();

        return $this->render('include/admin_valores.html.twig', [
            'valorfuncionario' => $vFuncionarioList
        ]);  //implementar rota
    }

    /**
     * @Route("/valorfuncionario/editar/{id}", name="editarValorFuncionario")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ValorfuncionarioRepository $valorfuncionarioRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, ValorfuncionarioRepository $valorfuncionarioRepository): Response
    {
        $vFuncionario = $valorfuncionarioRepository->find($id);
        $form = $this->createForm(valorfuncionarioType::class, $vFuncionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($vFuncionario);
            $em->flush();
            return $this->redirectToRoute('funcionario');
        }

        return $this->renderForm('view/admin/valorFuncionarioCadastrar.html.twig', [
            'valorfuncionario' => $form
        ]);  //implementar route
    }

    /**
     * @Route ("/valorfuncionario/excluir/{id}", name="deleteValorFuncionario")
     */
    public function remove(int $id, EntityManagerInterface $em, ValorfuncionarioRepository $valorfuncionarioRepository): Response
    {
        $vFuncionario = $valorfuncionarioRepository->find($id);
        $em->remove($vFuncionario);
        $em->flush();

        return $this->redirectToRoute('valorfuncionario');
    }
}