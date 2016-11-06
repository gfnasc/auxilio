<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicamento
 *
 * @ORM\Table(name="medicamento", indexes={@ORM\Index(name="fk_medicamento_principio_ativo_idx", columns={"principio_ativo_cod"})})
 * @ORM\Entity
 */
class Medicamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cod;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="apresentacao", type="string", length=20, nullable=false)
     */
    private $apresentacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd", type="integer", nullable=false)
     */
    private $qtd;

    /**
     * @var \PrincipioAtivo
     *
     * @ORM\ManyToOne(targetEntity="PrincipioAtivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="principio_ativo_cod", referencedColumnName="cod")
     * })
     */
    private $principioAtivoCod;


}

