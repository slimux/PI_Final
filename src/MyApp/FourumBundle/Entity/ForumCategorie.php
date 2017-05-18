<?php

namespace MyApp\FourumBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * ForumCategorie
 *
 * @ORM\Table(name="forum_categorie")
 * @ORM\Entity
 */
class ForumCategorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;
    /**
     * One Product has Many Features.
     * @OneToMany(targetEntity="ForumSousCategorie", mappedBy="idCategorie")
     */
    private $souscategories;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @return int
     */
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * @return mixed
     */
    public function getSouscategories()
    {
        return $this->souscategories;
    }

    /**
     * @param mixed $souscategories
     */
    public function setSouscategories($souscategories)
    {
        $this->souscategories = $souscategories;
    }

    /**
     * @param int $idCategorie
     */
    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;
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
    public function __toString()
    {
        return $this->titre;
    }

}

