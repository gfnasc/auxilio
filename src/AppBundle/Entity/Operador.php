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
     * @return Operador
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
     * @return Operador
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

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Operador
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }
}
