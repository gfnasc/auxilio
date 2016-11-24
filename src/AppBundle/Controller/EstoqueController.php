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
use Symfony\Component\HttpFoundation\JsonResponse;
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

    /**
     * @Route("/buscar-estoque", name="buscar-estoque")
     * @Method({"GET", "POST"})
     */
    public function buscaEstoque(Request $request){

        $term = $request->request->get('term');
        $tipo_busca = $request->request->get('tipo_busca');

        /*
         * TIPO BUSCA
         * 1 - Medicamento
         * 2 - Princípio ativo
         */
        if($tipo_busca == 1){
            $em = $this->getDoctrine()->getEntityManager();
            $qb = $em->createQueryBuilder();
            $meds = $qb->select('m')
                ->from('AppBundle:Medicamento', 'm')
                ->where('m.nome LIKE :term')
                ->setParameter(':term', '%'.$term.'%')
                ->getQuery()->getResult();

        } elseif($tipo_busca == 2){
            //IMPLEMENTAR BUSCA PA
        }

        $html = '
        <table class="table table-hover">
                                <tbody id="content-table">
        ';

        $html .= '
            <tr>
                <th>Nome</th>
                <th>Apresentação</th>
                <th>Princípio Ativo</th>
                <th>Quantidade</th>
                <th></th>
            </tr>
        ';

        foreach ($meds as $med){
            $html .= '
                <tr>
                    <td>'.$med->getNome().'</td>
                    <td>'.$med->getApresentacao().'</td>
                    <td>'.$med->getPrincipioAtivoCod()->getPrincipioAtivoNome().'</td>
                    <td>'.$med->getQtd().'</td>
                    <td style="text-align: right;">
                        <a href="editar-principio-ativo/'.$med->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-warning btn-flat">Editar</button></a>
                        <a href="deletar-principio-ativo/'.$med->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-danger btn-flat">Excluir</button></a>
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