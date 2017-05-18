<?php

namespace TGSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actualite
 *
 * @ORM\Table(name="actualite")
 * @ORM\Entity(repositoryClass="TGSBundle\Repository\ActualiteRepository")
 */
class Actualite
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_creation", type="date", nullable=false)
     */
    private $dateHeureCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="TGSBundle\Entity\MediaActu", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * Get image
     *
     * @return  \TGSBundle\Entity\MediaActu
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set image
     *
     * @param \TGSBundle\Entity\MediaActu $image
     *
     * @return Actualite
     */
    public function setImage(\TGSBundle\Entity\MediaActu $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}

