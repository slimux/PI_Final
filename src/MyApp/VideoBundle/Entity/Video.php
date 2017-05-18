<?php

namespace MyApp\VideoBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="MyApp\VideoBundle\Repository\VideoRepository")
 */
class Video
{
    /**
     * @return int
     */
    public function getIdVideo()
    {
        return $this->idVideo;
    }

    /**
     * @param int $idVideo
     */
    public function setIdVideo($idVideo)
    {
        $this->idVideo = $idVideo;
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
     * @return DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param DateTime $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @return string
     */
    public function getTypeVideo()
    {
        return $this->typeVideo;
    }

    /**
     * @param string $typeVideo
     */
    public function setTypeVideo($typeVideo)
    {
        $this->typeVideo = $typeVideo;
    }

    /**
     * @return string
     */
    public function getCodeVideo()
    {
        return $this->codeVideo;
    }

    /**
     * @param string $codeVideo
     */
    public function setCodeVideo($codeVideo)
    {
        $this->codeVideo = $codeVideo;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Video", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVideo;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000, nullable=false)
     */
    private $description;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime", nullable=false)
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="type_video", type="string", length=200, nullable=false)
     */
    private $typeVideo;

    /**
     * @var string
     *
     * @ORM\Column(name="code_video", type="string", length=255, nullable=false)
     */
    private $codeVideo;
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_vue", type="integer", length=255, nullable=false)
     */
    private $nbVue;

    /**
     * @return int
     */
    public function getNbVue()
    {
        return $this->nbVue;
    }

    /**
     * @param int $nbVue
     */
    public function setNbVue($nbVue)
    {
        $this->nbVue = $nbVue;
    }


}

