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
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Retiradas
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set operadorCod
     *
     * @param \AppBundle\Entity\Operador $operadorCod
     *
     * @return Retiradas
     */
    public function setOperadorCod(\AppBundle\Entity\Operador $operadorCod = null)
    {
        $this->operadorCod = $operadorCod;

        return $this;
    }

    /**
     * Get operadorCod
     *
     * @return \AppBundle\Entity\Operador
     */
    public function getOperadorCod()
    {
        return $this->operadorCod;
    }

    /**
     * Set pacienteCod
     *
     * @param \AppBundle\Entity\Paciente $pacienteCod
     *
     * @return Retiradas
     */
    public function setPacienteCod(\AppBundle\Entity\Paciente $pacienteCod = null)
    {
        $this->pacienteCod = $pacienteCod;

        return $this;
    }

    /**
     * Get pacienteCod
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getPacienteCod()
    {
        return $this->pacienteCod;
    }
}
