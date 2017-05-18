<?php

namespace MyApp\FourumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping\OneToMany;

/**
 * ForumTopics
 *
 * @ORM\Table(name="forum_topics", indexes={@ORM\Index(name="id_Createur", columns={"id_Createur"}), @ORM\Index(name="id_Createur_2", columns={"id_Createur"}), @ORM\Index(name="id_Createur_3", columns={"id_Createur"}), @ORM\Index(name="id_Createur_4", columns={"id_Createur"}), @ORM\Index(name="id_categorie", columns={"id_categorie"}), @ORM\Index(name="id_sous_categorie", columns={"id_sous_categorie"})})
 * @ORM\Entity(repositoryClass="MyApp\FourumBundle\Entity\ModeleRepository")
 */
class ForumTopics
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Topics", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */

    private $idTopics;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $nbvue;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=255, nullable=false)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_creation", type="datetime", nullable=false)
     */
    private $dateHeureCreation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="resolu", type="boolean", nullable=true)
     */
    private $resolu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notif_createur", type="boolean", nullable=true)
     */
    private $notifCreateur;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Createur", referencedColumnName="id")
     * })
     */
    private $idCreateur;

    /**
     * @var \ForumCategorie
     *
     * @ORM\ManyToOne(targetEntity="ForumCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categorie", referencedColumnName="id_categorie")
     * })
     */
    private $idCategorie;

    /**
     * @var \ForumSousCategorie
     *
     * @ORM\ManyToOne(targetEntity="ForumSousCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sous_categorie", referencedColumnName="id_sous_categorie")
     * })
     */

    private $idSousCategorie;
    /**
     * One Product has Many Features.
     * @OneToMany(targetEntity="ForumMessage", mappedBy="idTopics")
     */
    private $message;

    /**
     * @return int
     */
    public function getNbvue()
    {
        return $this->nbvue;
    }

    /**
     * @param int $nbvue
     */
    public function setNbvue($nbvue)
    {
        $this->nbvue = $nbvue;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
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
     * @return int
     */
    public function getIdTopics()
    {
        return $this->idTopics;
    }

    /**
     * @param int $idTopics
     */
    public function setIdTopics($idTopics)
    {
        $this->idTopics = $idTopics;
    }

    /**
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param string $sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
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
     * @return bool
     */
    public function isResolu()
    {
        return $this->resolu;
    }

    /**
     * @param bool $resolu
     */
    public function setResolu($resolu)
    {
        $this->resolu = $resolu;
    }

    /**
     * @return bool
     */
    public function isNotifCreateur()
    {
        return $this->notifCreateur;
    }

    /**
     * @param bool $notifCreateur
     */
    public function setNotifCreateur($notifCreateur)
    {
        $this->notifCreateur = $notifCreateur;
    }

    /**
     * @return \FosUser
     */
    public function getIdCreateur()
    {
        return $this->idCreateur;
    }

    /**
     * @param \FosUser $idCreateur
     */
    public function setIdCreateur($idCreateur)
    {
        $this->idCreateur = $idCreateur;
    }

    /**
     * @return \ForumCategorie
     */
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * @param \ForumCategorie $idCategorie
     */
    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;
    }

    /**
     * @return \ForumSousCategorie
     */
    public function getIdSousCategorie()
    {
        return $this->idSousCategorie;
    }

    /**
     * @param \ForumSousCategorie $idSousCategorie
     */
    public function setIdSousCategorie($idSousCategorie)
    {
        $this->idSousCategorie = $idSousCategorie;
    }

    public function __toString()
    {
        return $this->sujet;
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
    // ...

}

