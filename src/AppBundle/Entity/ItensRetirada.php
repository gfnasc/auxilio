<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItensRetirada
 *
 * @ORM\Table(name="itens_retirada", indexes={@ORM\Index(name="fk_itens_retirada_retiradas1_idx", columns={"retiradas_cod"}), @ORM\Index(name="fk_itens_retirada_medicamento1_idx", columns={"medicamento_cod"})})
 * @ORM\Entity
 */
class ItensRetirada
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
     * @ORM\Column(name="qtd_retirada", type="integer", nullable=false)
     */
    private $qtdRetirada;

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
     * @var \Retiradas
     *
     * @ORM\ManyToOne(targetEntity="Retiradas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="retiradas_cod", referencedColumnName="cod")
     * })
     */
    private $retiradasCod;



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
     * Set qtdRetirada
     *
     * @param integer $qtdRetirada
     *
     * @return ItensRetirada
     */
    public function setQtdRetirada($qtdRetirada)
    {
        $this->qtdRetirada = $qtdRetirada;

        return $this;
    }

    /**
     * Get qtdRetirada
     *
     * @return integer
     */
    public function getQtdRetirada()
    {
        return $this->qtdRetirada;
    }

    /**
     * Set medicamentoCod
     *
     * @param \AppBundle\Entity\Medicamento $medicamentoCod
     *
     * @return ItensRetirada
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

    /**
     * Set retiradasCod
     *
     * @param \AppBundle\Entity\Retiradas $retiradasCod
     *
     * @return ItensRetirada
     */
    public function setRetiradasCod(\AppBundle\Entity\Retiradas $retiradasCod = null)
    {
        $this->retiradasCod = $retiradasCod;

        return $this;
    }

    /**
     * Get retiradasCod
     *
     * @return \AppBundle\Entity\Retiradas
     */
    public function getRetiradasCod()
    {
        return $this->retiradasCod;
    }
}
