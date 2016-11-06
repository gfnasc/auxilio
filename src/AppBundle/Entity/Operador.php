<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operador
 *
 * @ORM\Table(name="operador")
 * @ORM\Entity
 */
class Operador
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
     * @ORM\Column(name="login", type="string", length=20, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=20, nullable=false)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;


}

