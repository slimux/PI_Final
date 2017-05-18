<?php

namespace MyApp\PIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Codes
 *
 * @ORM\Table(name="codes")
 * @ORM\Entity
 */
class Codes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_code", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     */
    private $code;

    /**
     * @var float
     *
     * @ORM\Column(name="quantite", type="float", precision=10, scale=0, nullable=false)
     */
    private $quantite;



    /**
     * Get idCode
     *
     * @return integer
     */
    public function getIdCode()
    {
        return $this->idCode;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return Codes
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set quantite
     *
     * @param float $quantite
     *
     * @return Codes
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return float
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
}
