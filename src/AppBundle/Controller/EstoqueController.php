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
                        <a href="inserir-medicamentos/'.$med->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-success btn-flat">Inserir</button></a>
                        <a href="lista-entradas/'.$med->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-warning btn-flat">Entrdas já cadastradas</button></a>
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

    /**
     * @Route("/lista-entradas/{id}", name="lista-entradas")
     * @Method({"GET", "POST"})
     */
    public function listarEntradasPorMedicamento($id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $entradas = $qb->select('e')
            ->from('AppBundle:Entradas', 'e')
            ->where('e.medicamentoCod = :id')
            ->setParameter(':id', $id)
            ->orderBy('e.dataEntrada', 'DESC')
            ->getQuery()->getResult();

        $medicamento = $em->getRepository('AppBundle:Medicamento')->find($id);

        return $this->render('system/estoque/listar-entradas.twig', [
            'entradas' => $entradas,
            'medicamento' => $medicamento
        ]);

    }

    /**
     * @Route("/solicitar-medicamentos", name="solicitar-medicamentos")
     */
    public function listarSolicitacaoEstoqueAction()
    {

        $em = $this->getDoctrine()->getManager();
        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();
        $entradas = $em->getRepository('AppBundle:Entradas')->findAll();

        return $this->render('system/estoque/solicitar-medicamentos.twig', [
            'medicamentos' => $medicamentos,
            'entradas' => $entradas
        ]);
    }

    /**
     * @Route("/buscar-estoque-solicitacao", name="buscar-estoque-solicitacao")
     * @Method({"GET", "POST"})
     */
    public function buscaSolicitacaoEstoque(Request $request){

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
                        <a href="gerar-solicitacao/'.$med->getCod().'" target="_blank"><button type="button" style="padding: 1px 2px;" class="btn btn-success btn-flat">Solicitar</button></a>
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

    /**
     * @Route("/gerar-solicitacao/{id}", name="gerar-solicitacao")
     * @Method({"GET", "POST"})
     */
    public function gerarSolicitacaoAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $med = $em->getRepository('AppBundle:Medicamento')->find($id);

        $content = '
            <h1 style="text-align: center;">HOSPITAL REGIONAL DE TEODORO SAMPAIO – SP</h1><br><br>
            <h3 style="text-align: center;">Solicitação de Medicamento</h3><br><br>
            <b>Dados do medicamento</b><br><br>
            <b>Nome: </b>'.$med->getNome().'<br>
            <b>Apresentação: </b>'.$med->getApresentacao().'<br>
            <b>Princípio Ativo: </b> '.$med->getPrincipioAtivoCod()->getPrincipioAtivoNome().'<br>
            <b>Quantidade: </b>______<br>
            <b>Data: </b>'.Carbon::now()->format('d/m/Y').'
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <p style="text-align: center;">________________________________________________</p>
            <p style="text-align: center;">Farmacêutico responsável</p>
        ';

        $html2pdf = new HTML2PDF('P','A4','pt', true, 'UTF-8', 10);
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('pedido-medicamento-'.$med->getNome().'.pdf');


    }

    /**
     * @Route("/retirar-medicamentos", name="retirar-medicamentos")
     * @Method({"GET", "POST"})
     */
    public function retirarMedicamentosAction()
    {

        $em = $this->getDoctrine()->getManager();
        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/estoque/retirar-medicamentos.twig', [
            'medicamentos' => $medicamentos
        ]);

    }

    /**
     * @Route("/retirar-medicamentos-interna/{id}", name="retirar-medicamentos-interna")
     * @Method({"GET", "POST"})
     */
    public function retirarMedicamentoAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $medicamento = $em->getRepository('AppBundle:Medicamento')->find($id);
        $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();

        return $this->render('system/estoque/retirar-medicamentos-interna.twig', [
            'medicamento' => $medicamento,
            'pacientes' => $pacientes
        ]);

    }

    /**
     * @Route("/retirar-medicamentos-action/{id}", name="retirar-medicamentos-action")
     * @Method({"GET", "POST"})
     */
    public function retirarMedicamento(Request $request, $id)
    {

        $data = $request->request->all();
        $em = $this->getDoctrine()->getManager();

        //Valida se existe a quantidade de medicamentos que está sendo solicitada na retirada.
        $m = $em->getRepository('AppBundle:Medicamento')->find($id);
        if($data['quantidade'] > (integer)$m->getQtd()){
            $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

            return $this->render('system/estoque/retirar-medicamentos.twig', [
                'medicamentos' => $medicamentos,
                'msg_fail' => 'Erro - Quantidade insuficiente no estoque!'
            ]);
        }

        //Subtrai do estoque
        if($data['quantidade'] <= (integer)$m->getQtd()){
            $nova_qtd = (integer)$m->getQtd() - (integer)$data['quantidade'];
            $m->setQtd($nova_qtd);
            $em->flush();
        }

        $retiradas = new Retiradas();
        $itens = new ItensRetirada();

        //preenche retiradas
        $retiradas->setData(Carbon::now()->toDateString());
        $retiradas->setOperadorCod($em->getReference('AppBundle:Operador', 1));
        $retiradas->setPacienteCod($em->getReference('AppBundle:Paciente', $data['paciente']));
        $em->persist($retiradas);
        $em->flush();

        $qb = $em->createQueryBuilder();
        $ultima_retirada = $qb->select('r')
            ->from('AppBundle:Retiradas', 'r')
            ->orderBy('r.cod', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getResult();

        //preenche intens retirada
        $itens->setMedicamentoCod($em->getReference('AppBundle:Medicamento', $id));
        $itens->setQtdRetirada($data['quantidade']);
        $itens->setRetiradasCod($em->getReference('AppBundle:Retiradas', $ultima_retirada[0]->getCod()));

        $em->persist($itens);
        $em->flush();

        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();

        return $this->render('system/estoque/retirar-medicamentos.twig', [
            'medicamentos' => $medicamentos,
            'msg' => 'Retirada efetuada com sucesso!'
        ]);

    }

    /**
     * @Route("/buscar-retirada", name="buscar-retirada")
     * @Method({"GET", "POST"})
     */
    public function buscaRetiradaEstoque(Request $request){

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
                        <a href="retirar-medicamentos-interna/'.$med->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-success btn-flat">Efetuar retirada</button></a>
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