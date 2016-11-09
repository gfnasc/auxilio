<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Paciente;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
class MedicamentosController extends Controller
{
    /**
     * @Route("/gerenciar-principio-ativo", name="gerenciar-principio-ativo")
     */
    public function listarAction()
    {

        $em = $this->getDoctrine()->getManager();
        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/medicamentos/gerenciar-principio-ativo.twig', [
            'medicamentos' => $medicamentos
        ]);
    }

    /**
     * @Route("/cadastrar-principio-ativo", name="cadastrar-principio-ativo")
     */
    public function cadastrarAction()
    {

        $em = $this->getDoctrine()->getManager();
        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/medicamentos/cadastrar-principio-ativo.twig', [
            'medicamentos' => $medicamentos
        ]);
    }

    /**
     * @Route("/gerenciar-medicamentos", name="gerenciar-medicamentos")
     */
    public function listarMedicamentosAction()
    {

        $em = $this->getDoctrine()->getManager();
        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/medicamentos/gerenciar-medicamentos.twig', [
            'medicamentos' => $medicamentos
        ]);
    }

    /**
     * @Route("/cadastrar-medicamentos", name="cadastrar-medicamentos")
     */
    public function cadastrarMedicamentosAction()
    {

        $em = $this->getDoctrine()->getManager();
        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/medicamentos/cadastrar-medicamentos.twig', [
            'medicamentos' => $medicamentos
        ]);
    }
}