<?php

namespace App\Controller;

use API\Form\FuncionarioType;
use App\Entity\Funcionario;
use App\Helper\FuncionariosFactory;
use App\Repository\FuncionarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FuncionarioController extends AbstractController
{

    /**
     *@var FuncionariosFactory
     */
    private FuncionariosFactory $funcionarioFactory;

    /**
     * @param FuncionariosFactory $funcionarioFactory
     *
     */
    public function __construct(
        FuncionariosFactory $funcionarioFactory
    ){
        $this->funcionarioFactory = $funcionarioFactory;
    }

    // ========== login =============
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('login.html.twig');
    }

    // rotas para as páginas
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    //rotas de cadastro
    /**
     *@Route ("/funcionario/cadastrar", name="cadastroFuncionario", methods={"POST|GET"})
     */
    public function novo(Request $request, EntityManagerInterface $em): Response
    {
        $return = $request->getContent();
        $functionary = $this->funcionarioFactory->criarFuncionario($return);

        //formulario de cadastro
        $form = $this->createForm(FuncionarioType::class, $functionary);

        //cadastrar funcionario novo
        $form->handleRequest($request);

        //para o botão cancelar
        if($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('funcionario');

        //para salvar
        if ($form->isSubmitted() && $form->isValid()){
            $functionary = $form->getData();
            $em->persist($functionary);
            $em->flush();
            return $this->redirectToRoute('funcionario');
        }

        return $this ->renderForm('view/admin/cadastrarFuncionario.html.twig', [
            'funcionario' => $form
        ]);
    }

    /**
     * @Route("/funcionario", name="funcionario", methods={"GET"})
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {

        $return = $doctrine->getRepository(Funcionario::class);
        $functionaryList = $return->findAll();

       // return new JsonResponse($functionaryList);
        return $this->render('view/admin/funcionario.html.twig', [
            'funcionario' =>$functionaryList
        ]);
    }

    /**
     * @Route("/funcionario/editar/{id}", name="editarFuncionario")
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, FuncionarioRepository $funcionarioRepository): Response
    {

        $functionary = $funcionarioRepository->find($id);
        $form = $this->createForm(FuncionarioType::class, $functionary);
        $form->handleRequest($request);

        //para o botão cancelar
        if($request->get('cancel') == 'Cancel')
            return $this->redirectToRoute('funcionario');

        // salvar
        if ($form->isSubmitted() && $form->isValid()){
            //$functionary = $form->getData();
            $em->persist($functionary);
            $em->flush();
            return $this->redirectToRoute('funcionario');


        }
        return $this ->renderForm('view/admin/cadastrarFuncionario.html.twig', [
            'funcionario' => $form
        ]);


    }

    /**
     * @Route("/funcionario/excluir/{id}", name="deleteFuncionario")
     */
    public function remove(int $id, EntityManagerInterface $em, FuncionarioRepository $funcionarioRepository): Response
    {

        $funcionario = $funcionarioRepository->find($id);
        $em->remove($funcionario);
        $em->flush();

        return $this->redirectToRoute('funcionario');
    }
}
