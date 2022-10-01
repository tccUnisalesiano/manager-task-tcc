<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteType;
use App\Helper\ClienteFactory;
use App\Repository\ClienteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe responsável por gerenciar os metodos de cliente
 * @author Guilherme Correia
 */
class ClienteController extends AbstractController
{
    /**
     * @var ClienteFactory
     */
    private ClienteFactory $clienteFactory;

    /**
     * @param ClienteFactory $clienteFactory
     */
    public function __construct(ClienteFactory $clienteFactory)
    {
        $this->clienteFactory = $clienteFactory;
    }


    //ajustar rota durante o desenvolvimento do front
    /**
     * @Route ("/cliente/cadastrar", name="cadastroCliente", methods={"POST|GET"})
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $cliente = $this->clienteFactory->criarCliente($return);

        // form
        $form = $this->createForm(ClienteType::class, $cliente);

        //cadastrar novo
        $form->handleRequest($request);

        //btn cancelar
        if ($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('cliente');    //implementar route

        //salvar
        if ($form->isSubmitted() && $form->isValid())
        {
            $cliente = $form->getData();
            $em->persist($cliente);
            $em->flush();
            return $this->redirectToRoute('cliente');   //implementar route
        }

        return $this->renderForm('view/Cadastros/Cliente/form/form.html.twig', [
            'cliente' => $form
        ]);
    }

    /**
     * @Route("/cliente", name="cliente", methods={"GET"})
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Cliente::class);
        $clienteList = $return->findAll();

        return $this->render('view/Cadastros/Cliente/index.html.twig', [
            'cliente' => $clienteList
        ]);  //implementar rota
    }

    /**
     * @Route("/cliente/editar/{id}", name="editarCliente")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ClienteRepository $clienteRepository
     * @return Response
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, ClienteRepository $clienteRepository): Response
    {
        $cliente = $clienteRepository->find($id);
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($cliente);
            $em->flush();
            return $this->redirectToRoute('cliente');
        }

        return $this->renderForm('view/Cadastros/Cliente/form/form.html.twig', [
            'cliente' => $form
        ]);  //implementar route
    }

    /**
     * @Route ("/cliente/excluir/{id}", name="deleteCliente")
     */
    public function remove(int $id, EntityManagerInterface $em, ClienteRepository $clienteRepository): Response
    {
        $cliente = $clienteRepository->find($id);
        $em->remove($cliente);
        $em->flush();

        return $this->redirectToRoute('cliente');
    }




    /**
     * @Route("/cliente/{id}", name="detalheCliente")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ClienteRepository $clienteRepository
     * @return Response
     */
    public function visualizar(int $id, Request $request, EntityManagerInterface $em, ClienteRepository $clienteRepository): Response
    {
        $cliente = $clienteRepository->find($id);

        return $this->render('view/Cadastros/Cliente/detalhes/clienteDetalhes.html.twig', [
            'cliente' => $cliente
        ]);
    }

}