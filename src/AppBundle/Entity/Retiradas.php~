<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Retiradas
 *
 * @ORM\Table(name="retiradas", indexes={@ORM\Index(name="fk_retiradas_operador1_idx", columns={"operador_cod"}), @ORM\Index(name="fk_retiradas_paciente1_idx", columns={"paciente_cod"})})
 * @ORM\Entity
 */
class Retiradas
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
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var \Operador
     *
     * @ORM\ManyToOne(targetEntity="Operador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="operador_cod", referencedColumnName="cod")
     * })
     */
    private $operadorCod;

    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_cod", referencedColumnName="cod")
     * })
     */
    private $pacienteCod;


}

