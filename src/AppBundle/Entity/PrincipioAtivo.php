<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrincipioAtivo
 *
 * @ORM\Table(name="principio_ativo")
 * @ORM\Entity
 */
class PrincipioAtivo
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
     * @ORM\Column(name="principio_ativo_nome", type="string", length=25, nullable=false)
     */
    private $principioAtivoNome;


}

