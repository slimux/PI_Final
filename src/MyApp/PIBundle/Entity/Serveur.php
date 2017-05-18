<?php

namespace MyApp\PIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serveur
 *
 * @ORM\Table(name="serveur")
 * @ORM\Entity
 */
class Serveur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Serveur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idServeur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="type_jeu", type="string", length=255, nullable=false)
     */
    private $typeJeu;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=false)
     */
    private $ip;

    /**
     * @return int
     */
    public function getIdServeur()
    {
        return $this->idServeur;
    }

    /**
     * @param int $idServeur
     */
    public function setIdServeur($idServeur)
    {
        $this->idServeur = $idServeur;
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
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getTypeJeu()
    {
        return $this->typeJeu;
    }

    /**
     * @param string $typeJeu
     */
    public function setTypeJeu($typeJeu)
    {
        $this->typeJeu = $typeJeu;
    }

    /**
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }


}

