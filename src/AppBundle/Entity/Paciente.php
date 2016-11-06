<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente")
 * @ORM\Entity
 */
class Paciente
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
     * @ORM\Column(name="matricula", type="integer", nullable=false)
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=20, nullable=false)
     */
    private $telefone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nasc", type="date", nullable=false)
     */
    private $dataNasc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cad", type="date", nullable=false)
     */
    private $dataCad;


}

