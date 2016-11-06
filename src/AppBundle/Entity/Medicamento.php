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
     * Set nome
     *
     * @param string $nome
     *
     * @return Medicamento
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

    /**
     * Set apresentacao
     *
     * @param string $apresentacao
     *
     * @return Medicamento
     */
    public function setApresentacao($apresentacao)
    {
        $this->apresentacao = $apresentacao;

        return $this;
    }

    /**
     * Get apresentacao
     *
     * @return string
     */
    public function getApresentacao()
    {
        return $this->apresentacao;
    }

    /**
     * Set qtd
     *
     * @param integer $qtd
     *
     * @return Medicamento
     */
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;

        return $this;
    }

    /**
     * Get qtd
     *
     * @return integer
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * Set principioAtivoCod
     *
     * @param \AppBundle\Entity\PrincipioAtivo $principioAtivoCod
     *
     * @return Medicamento
     */
    public function setPrincipioAtivoCod(\AppBundle\Entity\PrincipioAtivo $principioAtivoCod = null)
    {
        $this->principioAtivoCod = $principioAtivoCod;

        return $this;
    }

    /**
     * Get principioAtivoCod
     *
     * @return \AppBundle\Entity\PrincipioAtivo
     */
    public function getPrincipioAtivoCod()
    {
        return $this->principioAtivoCod;
    }
}
