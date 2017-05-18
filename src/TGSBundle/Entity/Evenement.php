<?php

namespace TGSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="TGSBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @var string
     *
     * @ORM\Column(name="descr", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="TGSBundle\Entity\MediaEvent", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieu", type="string", length=255, nullable=false)
     */
    private $lieu;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbpartcipant", type="integer", nullable=false)
     */
    private $nbpartcipant;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbpartcipantMax", type="integer", nullable=false)
     */
    private $nbpartcipantmax;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * Get image
     *
     * @return  \TGSBundle\Entity\MediaEvent
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param \TGSBundle\Entity\MediaEvent $image
     *
     * @return Evenement
     */
    public function setImage(\TGSBundle\Entity\MediaEvent $image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return int
     */
    public function getNbpartcipant()
    {
        return $this->nbpartcipant;
    }

    /**
     * @param int $nbpartcipant
     */
    public function setNbpartcipant($nbpartcipant)
    {
        $this->nbpartcipant = $nbpartcipant;
    }

    /**
     * @return int
     */
    public function getNbpartcipantmax()
    {
        return $this->nbpartcipantmax;
    }

    /**
     * @param int $nbpartcipantmax
     */
    public function setNbpartcipantmax($nbpartcipantmax)
    {
        $this->nbpartcipantmax = $nbpartcipantmax;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}

