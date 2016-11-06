<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entradas
 *
 * @ORM\Table(name="entradas", indexes={@ORM\Index(name="fk_entradas_medicamento1_idx", columns={"medicamento_cod"})})
 * @ORM\Entity
 */
class Entradas
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
     * @ORM\Column(name="numero_nf", type="string", length=45, nullable=false)
     */
    private $numeroNf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_entrada", type="date", nullable=false)
     */
    private $dataEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd_entrada", type="integer", nullable=false)
     */
    private $qtdEntrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validade_lote", type="date", nullable=false)
     */
    private $validadeLote;

    /**
     * @var \Medicamento
     *
     * @ORM\ManyToOne(targetEntity="Medicamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="medicamento_cod", referencedColumnName="cod")
     * })
     */
    private $medicamentoCod;


}

