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

class PacientesController extends Controller
{
    /**
     * @Route("/gerenciar-pacientes", name="gerenciar-pacientes")
     */
    public function listarAction()
    {

        $em = $this->getDoctrine()->getManager();
        $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();

        return $this->render('system/pacientes/gerenciar-pacientes.twig', [
            'pacientes' => $pacientes
        ]);
    }

    /**
     * @Route("/cadastrar-paciente", name="cadastrar-paciente")
     * @Method({"GET", "POST"})
     */
    public function cadastrarAction(Request $request)
    {

        $data = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();

        if(!$data){
            return $this->render('system/pacientes/cadastrar-paciente.twig');
        } else {

            $p = new Paciente();
            $p->setMatricula($data['matricula']);
            $p->setNome($data['nome']);
            $p->setTelefone($data['telefone']);
            $p->setDataNasc(new \DateTime('now'));
            $p->setDataCad(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();

            return $this->render('system/pacientes/gerenciar-pacientes.twig', [
                'msg' => 'Paciente cadastrado com sucesso!',
                'pacientes' => $pacientes
            ]);

        }

    }

    /**
     * @Route("/editar-pacientes/{id}", name="editar-pacientes")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, $id)
    {

        $data = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AppBundle:Paciente')->findBy(['cod' => $id]);

        if(!$data){
            return $this->render('system/pacientes/editar-paciente.twig', [
                'paciente' => $paciente
            ]);
        } else {

            $p = new Paciente();
            $p->setCod($id);
            $p->setMatricula($data['matricula']);
            $p->setNome($data['nome']);
            $p->setTelefone($data['telefone']);
            $p->setDataNasc(new \DateTime('now'));
            $p->setDataCad(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->merge($p);
            $em->flush();

            $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();

            return $this->render('system/pacientes/gerenciar-pacientes.twig', [
                'msg' => 'Paciente atualizado com sucesso!',
                'pacientes' => $pacientes
            ]);

        }
    }

    /**
     * @Route("/deletar-paciente/{id}", name="deletar-paciente")
     */
    public function deletarPaciente($id){

        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getReference('AppBundle:Paciente', $id);

        $em->remove($paciente);
        $em->flush();

        $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();

        return $this->render('system/pacientes/gerenciar-pacientes.twig', [
            'msg' => 'Paciente excluído com sucesso!',
            'pacientes' => $pacientes
        ]);
    }

}