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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
class MedicamentosController extends Controller
{

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
     * @Method({"GET", "POST"})
     */
    public function cadastrarMedicamentosAction(Request $request)
    {

        $data = $request->request->all();

        if(!$data){
            $em = $this->getDoctrine()->getManager();
            $pas = $em->getRepository('AppBundle:PrincipioAtivo')->findAll();

            return $this->render('system/medicamentos/cadastrar-medicamentos.twig', [
                'pas' => $pas
            ]);
        } else {

            $em = $this->getDoctrine()->getManager();

            $med = new Medicamento();
            $med->setApresentacao($data['apresentacao']);
            $med->setNome($data['nome']);
            $med->setPrincipioAtivoCod($em->getReference('AppBundle:PrincipioAtivo', $data['pa']));
            $med->setQtd(10);

            $em->persist($med);
            $em->flush();

            $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

            return $this->render('system/medicamentos/gerenciar-medicamentos.twig', [
                'msg' => 'Medicamento cadastrado com sucesso!',
                'medicamentos' => $medicamentos
            ]);

        }

    }

    /**
     * @Route("/editar-medicamento/{id}", name="editar-medicamento")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, $id)
    {

        $data = $request->request->all();

        if(!$data){

            $em = $this->getDoctrine()->getManager();
            $med = $em->getRepository('AppBundle:Medicamento')->findBy(['cod' => $id]);
            $pas = $em->getRepository('AppBundle:PrincipioAtivo')->findAll();

            return $this->render('system/medicamentos/editar-medicamento.twig', [
                'med' => $med,
                'pas' => $pas
            ]);
        } else {

            $em = $this->getDoctrine()->getManager();
            $med = $em->getRepository('AppBundle:Medicamento')->find($id);
            $med->setNome($data['nome']);
            $med->setApresentacao($data['apresentacao']);
            $med->setPrincipioAtivoCod($em->getReference('AppBundle:PrincipioAtivo', $data['pa']));
            $em->flush();

            $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

            return $this->render('system/medicamentos/gerenciar-medicamentos.twig', [
                'msg' => 'Medicamento atualizado com sucesso!',
                'medicamentos' => $medicamentos
            ]);

        }
    }

    /**
     * @Route("/deletar-medicamento/{id}", name="deletar-medicamento")
     */
    public function deletarMedicamentoAction($id){

        $em = $this->getDoctrine()->getManager();
        $pa = $em->getReference('AppBundle:Medicamento', $id);

        $em->remove($pa);
        $em->flush();

        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/medicamentos/gerenciar-medicamentos.twig', [
            'msg' => 'Medicamento excluído com sucesso!',
            'medicamentos' => $medicamentos
        ]);
    }

    /**
     * @Route("/buscar-medicamento", name="buscar-medicamento")
     * @Method({"GET", "POST"})
     */
    public function buscaMedicamento(Request $request){

        $term = $request->request->get('term');

        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $meds = $qb->select('m')
            ->from('AppBundle:Medicamento', 'm')
            ->where('m.nome LIKE :term')
            ->setParameter(':term', '%'.$term.'%')
            ->getQuery()->getResult();

        $html = '
        <table class="table table-hover">
                                <tbody id="content-table">
        ';

        $html .= '
            <tr>
                <th>Nome</th>
                <th>Apresentação</th>
                <th>Princípio Ativo</th>
                <th></th>
            </tr>
        ';

        foreach ($meds as $med){
            $html .= '
                <tr>
                    <td>'.$med->getNome().'</td>
                    <td>'.$med->getApresentacao().'</td>
                    <td>'.$med->getNome().'</td>
                    <td style="text-align: right;">
                        <a href="editar-principio-ativo/'.$meds->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-warning btn-flat">Editar</button></a>
                        <a href="deletar-principio-ativo/'.$meds->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-danger btn-flat">Excluir</button></a>
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