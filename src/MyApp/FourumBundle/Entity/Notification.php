<?php

namespace MyApp\FourumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="idforum", columns={"idforum"}), @ORM\Index(name="idmembre", columns={"idmembre"}), @ORM\Index(name="idmembre_2", columns={"idmembre"})})
 * @ORM\Entity
 */
class Notification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmembre", referencedColumnName="id")
     * })
     */
    private $idmembre;

    /**
     * @var \ForumTopics
     *
     * @ORM\ManyToOne(targetEntity="ForumTopics")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idforum", referencedColumnName="id_Topics")
     * })
     */
    private $idforum;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \FosUser
     */
    public function getIdmembre()
    {
        return $this->idmembre;
    }

    /**
     * @param \FosUser $idmembre
     */
    public function setIdmembre($idmembre)
    {
        $this->idmembre = $idmembre;
    }

    /**
     * @return \ForumTopics
     */
    public function getIdforum()
    {
        return $this->idforum;
    }

    /**
     * @param \ForumTopics $idforum
     */
    public function setIdforum($idforum)
    {
        $this->idforum = $idforum;
    }


}

