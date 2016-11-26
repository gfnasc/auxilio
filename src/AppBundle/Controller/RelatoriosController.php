<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Entradas;
use AppBundle\Entity\ItensRetirada;
use AppBundle\Entity\Paciente;
use AppBundle\Entity\Retiradas;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;
use HTML2PDF;
use Symfony\Component\Validator\Constraints\Date;
use Carbon\Carbon;

class RelatoriosController extends Controller
{
    /**
     * @Route("/relatorio-pacientes", name="relatorio-pacientes")
     */
    public function relatorioPacientes()
    {

        $em = $this->getDoctrine()->getManager();
        $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();

        return $this->render('system/relatorios/relatorio-pacientes.twig', [
            'pacientes' => $pacientes
        ]);
    }

    /**
     * @Route("/relatorio-pacientes/{id}", name="relatorio-pacientes-interna")
     * @Method({"GET", "POST"})
     */
    public function relatorioPacientesAction($id)
    {

        $em = $this->getDoctrine()->getManager();
//        $retiradas = $em->getRepository('AppBundle:Retiradas')->findBy(['pacienteCod' => $id]);
        $retiradas = $em->getRepository('AppBundle:ItensRetirada')->findAll();
        $paciente = $em->getRepository('AppBundle:Paciente')->find($id);

//        $qb = $em->createQueryBuilder();
//        $qb->select('r')
//            ->from('AppBundle:Retiradas', 'r')


        var_dump($retiradas);
        exit;

        return $this->render('system/relatorios/relatorio-pacientes-action.twig', [
            'retiradas' => $retiradas,
            'paciente' => $paciente
        ]);
    }
}