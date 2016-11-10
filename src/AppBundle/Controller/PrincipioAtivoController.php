<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Medicamento;
use AppBundle\Entity\Paciente;
use AppBundle\Entity\PrincipioAtivo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
class PrincipioAtivoController extends Controller
{
    /**
     * @Route("/gerenciar-principio-ativo", name="gerenciar-principio-ativo")
     */
    public function listarAction()
    {

        $em = $this->getDoctrine()->getManager();
        $principio_ativo = $em->getRepository('AppBundle:PrincipioAtivo')->findAll();

        return $this->render('system/principio-ativo/gerenciar-principio-ativo.twig', [
            'principio_ativo' => $principio_ativo
        ]);
    }

    /**
     * @Route("/cadastrar-principio-ativo", name="cadastrar-principio-ativo")
     * @Method({"GET", "POST"})
     */
    public function cadastrarAction(Request $request)
    {

        $data = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $principio_ativo = $em->getRepository('AppBundle:PrincipioAtivo')->findAll();

        if(!$data){
            return $this->render('system/principio-ativo/cadastrar-principio-ativo.twig');
        } else {

            $pa = new PrincipioAtivo();
            $pa->setPrincipioAtivoNome($data['nome']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($pa);
            $em->flush();

            return $this->render('system/principio-ativo/gerenciar-principio-ativo.twig', [
                'msg' => 'Principio Ativo cadastrado com sucesso!',
                'principio_ativo' => $principio_ativo
            ]);

        }
    }

}