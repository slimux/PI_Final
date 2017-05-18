<?php

namespace MyApp\PIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table(name="produits")
 * @ORM\Entity(repositoryClass="MyApp\PIBundle\Repository\ProduitsRepository")
 */
class Produits
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="MyApp\PIBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
    * @ORM\ManyToOne(targetEntity="MyApp\PIBundle\Entity\Categories", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\PIBundle\Entity\Tva", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tva;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var bool
     *
     * @ORM\Column(name="disponible", type="boolean")
     */
    private $disponible;

    /**
     * @var float
     *
     * @ORM\Column(name="note_presse", type="float")
     */
    private $note_presse;

    /**
     * @var float
     *
     * @ORM\Column(name="note_globale", type="float")
     */
    private $note_globale;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255)
     */
    private $video;

    /**
     * @return float
     */
    public function getNotePresse()
    {
        return $this->note_presse;
    }

    /**
     * @param float $note_presse
     */
    public function setNotePresse($note_presse)
    {
        $this->note_presse = $note_presse;
    }

    /**
     * @return float
     */
    public function getNoteGlobale()
    {
        return $this->note_globale;
    }

    /**
     * @param float $note_globale
     */
    public function setNoteGlobale($note_globale)
    {
        $this->note_globale = $note_globale;
    }

    /**
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Produits
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produits
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produits
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Produits
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return bool
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set image
     *
     * @param \MyApp\PIBundle\Entity\Media $image
     *
     * @return Produits
     */
    public function setImage(\MyApp\PIBundle\Entity\Media $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MyApp\PIBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set categorie
     *
     * @param \MyApp\PIBundle\Entity\Categories $categorie
     *
     * @return Produits
     */
    public function setCategorie(\MyApp\PIBundle\Entity\Categories $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \MyApp\PIBundle\Entity\Categories
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set tva
     *
     * @param \MyApp\PIBundle\Entity\Tva $tva
     *
     * @return Produits
     */
    public function setTva(\MyApp\PIBundle\Entity\Tva $tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return \MyApp\PIBundle\Entity\Tva
     */
    public function getTva()
    {
        return $this->tva;
    }
}
