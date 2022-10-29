<?php

namespace App\Controller;

use App\Form\FuncionarioType;
use App\Entity\Funcionario;
use App\Helper\FuncionariosFactory;
use App\Repository\FuncionarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\Form\FormBuilderInterface;

class FuncionarioController extends AbstractController
{

    /**
     *@var FuncionariosFactory
     */
    private FuncionariosFactory $funcionarioFactory;


    /**
     * @param FuncionariosFactory $funcionarioFactory
     * @param UploaderHelper $uploaderHelper
     */
    public function __construct(
        FuncionariosFactory $funcionarioFactory, UploaderHelper $uploaderHelper
    ){
        $this->funcionarioFactory = $funcionarioFactory;
        $this->uploaderHelper = $uploaderHelper;
    }


    //rotas de cadastro
    /**
     *@Route ("/funcionario/cadastrar", name="cadastroFuncionario", methods={"POST|GET"}, defaults={"title": "Cadastrar Funcionário"})
     */
    public function novo(Request $request, EntityManagerInterface $em, string $title): Response
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

        return $this ->renderForm('view/Cadastros/Funcionario/Form/form.html.twig', [
            'funcionario' => $form, 'title' => $title,
            $this->uploaderHelper->asset($form, 'imageName')

        ]);

    }

    /**
     * @Route("/funcionario", name="funcionario", methods={"GET"})
     */
    public function buscarTodos(ManagerRegistry $doctrine): Response
    {
        $return = $doctrine->getRepository(Funcionario::class);
        $functionaryList = $return->findAll();

        return $this->render('view/Cadastros/Funcionario/index.html.twig', [
            'funcionario' =>$functionaryList
        ]);
    }

    /**
     * @Route("/funcionario/editar/{id}", name="editarFuncionario", defaults={"title": "Alterar Funcionário"})
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, FuncionarioRepository $funcionarioRepository, string $title): Response
    {

        $functionary = $funcionarioRepository->find($id);
        $form = $this->createForm(FuncionarioType::class, $functionary);
        $form->handleRequest($request);
//        $form['imageFile'] = $this->uploaderHelper->asset($form, 'imageName');
        $form['ImageFile'] = [
            $this->uploaderHelper->asset($form, 'imageName')
        ];

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
        return $this ->renderForm('view/Cadastros/Funcionario/Form/form.html.twig', [
            'funcionario' => $form, 'title' => $title
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


    /**
     * @Route("/funcionario/{id}", name="detalheFuncionario")
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param FuncionarioRepository $funcionarioRepository
     * @return Response
     */
    public function visualizar(int $id, Request $request, EntityManagerInterface $em, FuncionarioRepository $funcionarioRepository): Response
    {
        $funcionario = $funcionarioRepository->find($id);

        return $this->render('view/Cadastros/Funcionario/detalhes/funcionarioDetalhes.html.twig', [
            'funcionario' => $funcionario
        ]);
    }
}