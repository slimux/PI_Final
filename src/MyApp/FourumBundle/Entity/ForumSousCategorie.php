<?php

namespace MyApp\FourumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
/**
 * ForumSousCategorie
 *
 * @ORM\Table(name="forum_sous_categorie", indexes={@ORM\Index(name="id_categorie", columns={"id_categorie"})})
 * @ORM\Entity
 */
class ForumSousCategorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sous_categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSousCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

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
     * One Product has Many Features.
     * @OneToMany(targetEntity="ForumTopics", mappedBy="idSousCategorie")
     */
    private $topic;
    /**
     * @return int
     */
    public function getIdSousCategorie()
    {
        return $this->idSousCategorie;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * @param int $idSousCategorie
     */
    public function setIdSousCategorie($idSousCategorie)
    {
        $this->idSousCategorie = $idSousCategorie;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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

    public function __toString()
    {
        return $this->titre;
    }
}

