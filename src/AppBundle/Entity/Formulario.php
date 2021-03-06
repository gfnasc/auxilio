<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formulario
 *
 * @ORM\Table(name="formulario", indexes={@ORM\Index(name="fk_formulario_medicamento1_idx", columns={"medicamento_cod"})})
 * @ORM\Entity
 */
class Formulario
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
     * @ORM\Column(name="qtd_pedir", type="integer", nullable=false)
     */
    private $qtdPedir;

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
     * Set qtdPedir
     *
     * @param integer $qtdPedir
     *
     * @return Formulario
     */
    public function setQtdPedir($qtdPedir)
    {
        $this->qtdPedir = $qtdPedir;

        return $this;
    }

    /**
     * Get qtdPedir
     *
     * @return integer
     */
    public function getQtdPedir()
    {
        return $this->qtdPedir;
    }

    /**
     * Set medicamentoCod
     *
     * @param \AppBundle\Entity\Medicamento $medicamentoCod
     *
     * @return Formulario
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
