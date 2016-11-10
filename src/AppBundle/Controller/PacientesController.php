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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
            $p->setDataNasc($data['data-nascimento']);
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
            $p->setDataNasc($data['data-nascimento']);
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

    /**
     * @Route("/buscar-paciente", name="buscar-paciente")
     * @Method({"GET", "POST"})
     */
    public function buscaPaciente(Request $request){

        $term = $request->request->get('term');

        if($term[0] == '0' or $term[0] == '0' or $term[0] == '1' or $term[0] == '2' or $term[0] == '3' or $term[0] == '4' or $term[0] == '5' or $term[0] == '6' or $term[0] == '7' or $term[0] == '8' or $term[0] == '9'){
            $em = $this->getDoctrine()->getEntityManager();
            $qb = $em->createQueryBuilder();
            $pacientes = $qb->select('p')
                ->from('AppBundle:Paciente', 'p')
                ->where('p.matricula LIKE :term')
                ->setParameter(':term', '%'.$term.'%')
                ->getQuery()->getResult();
        } elseif($term == ''){
            $em = $this->getDoctrine()->getEntityManager();
            $qb = $em->createQueryBuilder();
            $pacientes = $qb->select('p')
                ->from('AppBundle:Paciente', 'p')
                ->getQuery()->getResult();
        } else {
            $em = $this->getDoctrine()->getEntityManager();
            $qb = $em->createQueryBuilder();
            $pacientes = $qb->select('p')
                ->from('AppBundle:Paciente', 'p')
                ->where('p.nome LIKE :term')
                ->setParameter(':term', '%'.$term.'%')
                ->getQuery()->getResult();
        }

        $html = '
        <table class="table table-hover">
                                <tbody id="content-table">
        ';

        $html .= '
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Data de Cadastro</th>
                <th></th>
            </tr>
        ';

        foreach ($pacientes as $paciente){
            $html .= '
                <tr>
                    <td>'.$paciente->getMatricula().'</td>
                    <td>'.$paciente->getNome().'</td>
                    <td>'.$paciente->getTelefone().'</td>
                    <td>'.date_format($paciente->getDataNasc(), "Y-m-d").'</td>
                    <td>'.date_format($paciente->getDataCad(), "Y-m-d").'</td>
                    <td style="text-align: right;">
                        <a href="editar-paciente/'.$paciente->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-warning btn-flat">Editar</button></a>
                        <a href="deletar-paciente/'.$paciente->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-danger btn-flat">Excluir</button></a>
                    </td>
                </tr>
            ';
        }

        $html .= '
        </tbody>
        </table>
        ';


        return new JsonResponse($html);
    }

}