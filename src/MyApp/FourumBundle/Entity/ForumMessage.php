<?php

namespace MyApp\FourumBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * ForumMessage
 *
 * @ORM\Table(name="forum_message")
 * @ORM\Entity(repositoryClass="MyApp\FourumBundle\Entity\ModeleRepository")
 */
class ForumMessage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_creation", type="date", nullable=false)
     */
    private $dateHeureCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_edition", type="datetime", nullable=true)
     */
    private $dateHeureEdition;

    /**
     * @var integer
     *
     * @ORM\Column(name="meilleure_reponse", type="integer", nullable=true)
     */
    private $meilleureReponse;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nblike;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbdeslike;
    /**
     * @var \ForumTopics
     *
     * @ORM\ManyToOne(targetEntity="ForumTopics")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Topics", referencedColumnName="id_Topics")
     * })
     */
    private $idTopics;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Posteur", referencedColumnName="id")
     * })
     */
    private $idPosteur;

    /**
     * @return int
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * @param int $idMessage
     */
    public function setIdMessage($idMessage)
    {
        $this->idMessage = $idMessage;
    }

    /**
     * @return \DateTime
     */
    public function getDateHeureCreation()
    {
        return $this->dateHeureCreation;
    }

    /**
     * @param \DateTime $dateHeureCreation
     */
    public function setDateHeureCreation($dateHeureCreation)
    {
        $this->dateHeureCreation = $dateHeureCreation;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return \DateTime
     */
    public function getDateHeureEdition()
    {
        return $this->dateHeureEdition;
    }

    /**
     * @param \DateTime $dateHeureEdition
     */
    public function setDateHeureEdition($dateHeureEdition)
    {
        $this->dateHeureEdition = $dateHeureEdition;
    }

    /**
     * @return int
     */
    public function getMeilleureReponse()
    {
        return $this->meilleureReponse;
    }

    /**
     * @param int $meilleureReponse
     */
    public function setMeilleureReponse($meilleureReponse)
    {
        $this->meilleureReponse = $meilleureReponse;
    }

    /**
     * @return \ForumTopics
     */
    public function getIdTopics()
    {
        return $this->idTopics;
    }

    /**
     * @param \ForumTopics $idTopics
     */
    public function setIdTopics($idTopics)
    {
        $this->idTopics = $idTopics;
    }

    /**
     * @return \FosUser
     */
    public function getIdPosteur()
    {
        return $this->idPosteur;
    }

    /**
     * @param \FosUser $idPosteur
     */
    public function setIdPosteur($idPosteur)
    {
        $this->idPosteur = $idPosteur;
    }
    public function __toString()
    {
        return $this->contenu;
    }

    /**
     * @return int
     */
    public function getNblike()
    {
        return $this->nblike;
    }

    /**
     * @param int $nblike
     */
    public function setNblike($nblike)
    {
        $this->nblike = $nblike;
    }

    /**
     * @return int
     */
    public function getNbdeslike()
    {
        return $this->nbdeslike;
    }

    /**
     * @param int $nbdeslike
     */
    public function setNbdeslike($nbdeslike)
    {
        $this->nbdeslike = $nbdeslike;
    }
}

