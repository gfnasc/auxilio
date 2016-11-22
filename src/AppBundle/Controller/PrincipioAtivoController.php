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

        if(!$data){
            return $this->render('system/principio-ativo/cadastrar-principio-ativo.twig');
        } else {

            $em = $this->getDoctrine()->getManager();
            $principio_ativo = $em->getRepository('AppBundle:PrincipioAtivo')->findAll();

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

    /**
     * @Route("/editar-principio-ativo/{id}", name="editar-principio-ativo")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, $id)
    {

        $data = $request->request->all();

        if(!$data){

            $em = $this->getDoctrine()->getManager();
            $principio_ativo = $em->getRepository('AppBundle:PrincipioAtivo')->findBy(['cod' => $id]);

            return $this->render('system/principio-ativo/editar-principio-ativo.twig', [
                'principio_ativo' => $principio_ativo
            ]);
        } else {

            $em = $this->getDoctrine()->getManager();
            $pa = $em->getRepository('AppBundle:PrincipioAtivo')->find($id);
            $pa->setPrincipioAtivoNome($data['nome']);
            $em->flush();

            $principio_ativo = $em->getRepository('AppBundle:PrincipioAtivo')->findAll();

            return $this->render('system/principio-ativo/gerenciar-principio-ativo.twig', [
                'msg' => 'Princípio Ativo atualizado com sucesso!',
                'principio_ativo' => $principio_ativo
            ]);

        }
    }

    /**
     * @Route("/deletar-principio-ativo/{id}", name="deletar-principio-ativo")
     */
    public function deletarPrincipioAtivo($id){

        $em = $this->getDoctrine()->getManager();
        $pa = $em->getReference('AppBundle:PrincipioAtivo', $id);

        $em->remove($pa);
        $em->flush();

        $pas = $em->getRepository('AppBundle:PrincipioAtivo')->findAll();

        return $this->render('system/principio-ativo/gerenciar-principio-ativo.twig', [
            'msg' => 'Paciente excluído com sucesso!',
            'principio_ativo' => $pas
        ]);
    }

    /**
     * @Route("/buscar-principio-ativo", name="buscar-principio-ativo")
     * @Method({"GET", "POST"})
     */
    public function buscaPaciente(Request $request){

        $term = $request->request->get('term');

        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $pas = $qb->select('p')
            ->from('AppBundle:PrincipioAtivo', 'p')
            ->where('p.principioAtivoNome LIKE :term')
            ->setParameter(':term', '%'.$term.'%')
            ->getQuery()->getResult();

        $html = '
        <table class="table table-hover">
                                <tbody id="content-table">
        ';

        $html .= '
            <tr>
                <th>Nome</th>
                <th></th>
            </tr>
        ';

        foreach ($pas as $pa){
            $html .= '
                <tr>
                    <td>'.$pa->getPrincipioAtivoNome().'</td>
                    <td style="text-align: right;">
                        <a href="editar-principio-ativo/'.$pa->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-warning btn-flat">Editar</button></a>
                        <a href="deletar-principio-ativo/'.$pa->getCod().'"><button type="button" style="padding: 1px 2px;" class="btn btn-danger btn-flat">Excluir</button></a>
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