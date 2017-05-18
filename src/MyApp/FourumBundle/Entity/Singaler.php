<?php

namespace MyApp\FourumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Singaler
 *
 * @ORM\Table(name="singaler", indexes={@ORM\Index(name="idTopic", columns={"idTopic"}), @ORM\Index(name="idmembre", columns={"idmembre"}), @ORM\Index(name="idCommentaire", columns={"idCommentaire"})})
 * @ORM\Entity(repositoryClass="MyApp\FourumBundle\Entity\ModeleRepository")
 */
class Singaler
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
     * @var string
     *
     * @ORM\Column(name="cause", type="string", nullable=false)
     */
    private $cause;

    /**
     * @var \ForumMessage
     *
     * @ORM\ManyToOne(targetEntity="MyApp\FourumBundle\Entity\ForumMessage")
     * * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcommentaire", referencedColumnName="id_Message",nullable=false)
     * })
     */
    private $idcommentaire;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ForumTopics")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTopic", referencedColumnName="id_Topics",nullable=false)
     * })
     */
    private $idtopic;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmembre", referencedColumnName="id")
     * })
     */
    private $idmembre;

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
     * @return string
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @param string $cause
     */
    public function setCause($cause)
    {
        $this->cause = $cause;
    }

    /**
     * @return \ForumMessage
     */
    public function getIdcommentaire()
    {
        return $this->idcommentaire;
    }

    /**
     * @param \ForumMessage $idcommentaire
     */
    public function setIdcommentaire($idcommentaire)
    {
        $this->idcommentaire = $idcommentaire;
    }

    /**
     * @return \ForumTopics
     */
    public function getIdtopic()
    {
        return $this->idtopic;
    }

    /**
     * @param \ForumTopics $idtopic
     */
    public function setIdtopic($idtopic)
    {
        $this->idtopic = $idtopic;
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


}

