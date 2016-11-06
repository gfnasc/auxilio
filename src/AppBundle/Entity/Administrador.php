<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador")
 * @ORM\Entity
 */
class Administrador
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
     * Get cod
     *
     * @return integer
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Administrador
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set senha
     *
     * @param string $senha
     *
     * @return Administrador
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get senha
     *
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }
}
