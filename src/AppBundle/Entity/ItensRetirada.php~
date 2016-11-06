<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItensRetirada
 *
 * @ORM\Table(name="itens_retirada", indexes={@ORM\Index(name="fk_itens_retirada_retiradas1_idx", columns={"retiradas_cod"}), @ORM\Index(name="fk_itens_retirada_medicamento1_idx", columns={"medicamento_cod"})})
 * @ORM\Entity
 */
class ItensRetirada
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
     * @var integer
     *
     * @ORM\Column(name="qtd_retirada", type="integer", nullable=false)
     */
    private $qtdRetirada;

    /**
     * @var \Medicamento
     *
     * @ORM\ManyToOne(targetEntity="Medicamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="medicamento_cod", referencedColumnName="cod")
     * })
     */
    private $medicamentoCod;

    /**
     * @var \Retiradas
     *
     * @ORM\ManyToOne(targetEntity="Retiradas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="retiradas_cod", referencedColumnName="cod")
     * })
     */
    private $retiradasCod;


}

