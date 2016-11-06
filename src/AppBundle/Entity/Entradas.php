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
     * Set numeroNf
     *
     * @param string $numeroNf
     *
     * @return Entradas
     */
    public function setNumeroNf($numeroNf)
    {
        $this->numeroNf = $numeroNf;

        return $this;
    }

    /**
     * Get numeroNf
     *
     * @return string
     */
    public function getNumeroNf()
    {
        return $this->numeroNf;
    }

    /**
     * Set dataEntrada
     *
     * @param \DateTime $dataEntrada
     *
     * @return Entradas
     */
    public function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;

        return $this;
    }

    /**
     * Get dataEntrada
     *
     * @return \DateTime
     */
    public function getDataEntrada()
    {
        return $this->dataEntrada;
    }

    /**
     * Set qtdEntrada
     *
     * @param integer $qtdEntrada
     *
     * @return Entradas
     */
    public function setQtdEntrada($qtdEntrada)
    {
        $this->qtdEntrada = $qtdEntrada;

        return $this;
    }

    /**
     * Get qtdEntrada
     *
     * @return integer
     */
    public function getQtdEntrada()
    {
        return $this->qtdEntrada;
    }

    /**
     * Set validadeLote
     *
     * @param \DateTime $validadeLote
     *
     * @return Entradas
     */
    public function setValidadeLote($validadeLote)
    {
        $this->validadeLote = $validadeLote;

        return $this;
    }

    /**
     * Get validadeLote
     *
     * @return \DateTime
     */
    public function getValidadeLote()
    {
        return $this->validadeLote;
    }

    /**
     * Set medicamentoCod
     *
     * @param \AppBundle\Entity\Medicamento $medicamentoCod
     *
     * @return Entradas
     */
    public function setMedicamentoCod(\AppBundle\Entity\Medicamento $medicamentoCod = null)
    {
        $this->medicamentoCod = $medicamentoCod;

        return $this;
    }

    /**
     * Get medicamentoCod
     *
     * @return \AppBundle\Entity\Medicamento
     */
    public function getMedicamentoCod()
    {
        return $this->medicamentoCod;
    }
}
