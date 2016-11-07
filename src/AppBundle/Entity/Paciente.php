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
     * @ORM\Column(name="data_nasc", type="datetime", nullable=false)
     */
    private $dataNasc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cad", type="datetime", nullable=false)
     */
    private $dataCad;



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
     * Set matricula
     *
     * @param integer $cod
     *
     * @return Paciente
     */
    public function setCod($cod)
    {
        $this->cod = $cod;

        return $this;
    }

    /**
     * Set matricula
     *
     * @param integer $matricula
     *
     * @return Paciente
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula
     *
     * @return integer
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Paciente
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
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Paciente
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set dataNasc
     *
     * @param \DateTime $dataNasc
     *
     * @return Paciente
     */
    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;

        return $this;
    }

    /**
     * Get dataNasc
     *
     * @return \DateTime
     */
    public function getDataNasc()
    {
        return $this->dataNasc;
    }

    /**
     * Set dataCad
     *
     * @param \DateTime $dataCad
     *
     * @return Paciente
     */
    public function setDataCad($dataCad)
    {
        $this->dataCad = $dataCad;

        return $this;
    }

    /**
     * Get dataCad
     *
     * @return \DateTime
     */
    public function getDataCad()
    {
        return $this->dataCad;
    }
}
