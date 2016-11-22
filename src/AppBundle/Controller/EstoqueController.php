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
class EstoqueController extends Controller
{
    /**
     * @Route("/entrada-medicamentos", name="entrada-medicamentos")
     */
    public function listarAction()
    {

        $em = $this->getDoctrine()->getManager();
        $estoque = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/estoque/entrada-medicamentos.twig', [
            'estoque' => $estoque
        ]);
    }

    /**
     * @Route("/inserir-medicamentos", name="inserir-medicamentos")
     */
    public function listarTesteAction()
    {

        $em = $this->getDoctrine()->getManager();
        $estoque = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/estoque/inserir-medicamentos.twig', [
            'estoque' => $estoque
        ]);
    }
}