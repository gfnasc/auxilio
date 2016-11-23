<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Entradas;
use AppBundle\Entity\Paciente;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Symfony\Component\Validator\Constraints\Date;
use Carbon\Carbon;

class EstoqueController extends Controller
{
    /**
     * @Route("/entrada-medicamentos", name="entrada-medicamentos")
     */
    public function listarEstoqueAction()
    {

        $em = $this->getDoctrine()->getManager();
        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();
        $entradas = $em->getRepository('AppBundle:Entradas')->findAll();

        return $this->render('system/estoque/gerenciar-estoque.twig', [
            'medicamentos' => $medicamentos,
            'entradas' => $entradas
        ]);
    }

    /**
     * @Route("/inserir-medicamentos/{id}", name="inserir-medicamentos")
     * @Method({"GET", "POST"})
     */
    public function inserirEstoqueAction(Request $request, $id)
    {

        $data = $request->request->all();

        if(!$data){

            $em = $this->getDoctrine()->getManager();
            $medicamento = $em->getRepository('AppBundle:Medicamento')->find($id);

            return $this->render('system/estoque/inserir-estoque.twig', [
                'medicamento' => $medicamento
            ]);

        } else {

            $em = $this->getDoctrine()->getManager();
            $e = new Entradas();

            //Cria novo registro para a tabela de entrada de medicamentos
            $e->setNumeroNf($data['nf']);
            $e->setQtdEntrada($data['quantidade']);
            $e->setValidadeLote($data['validade']);
            $e->setMedicamentoCod($em->getReference('AppBundle:Medicamento', $id));
            $e->setDataEntrada(new DateTime('now'));

            $em->persist($e);
            $em->flush();

            //Atualiza a quantidade na tabela de medicamentos
            $med = $em->getRepository('AppBundle:Medicamento')->find($id);
            $med->setQtd((integer)$med->getQtd() + (integer)$data['quantidade']);
            $em->flush();


            $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

            return $this->render('system/estoque/gerenciar-estoque.twig', [
                'msg' => 'Entrada efetuada com sucesso!',
                'medicamentos' => $medicamentos
            ]);

        }

    }
}