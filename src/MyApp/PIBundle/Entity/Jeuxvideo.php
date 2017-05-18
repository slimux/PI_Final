<?php

namespace MyApp\PIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jeuxvideo
 *
 * @ORM\Table(name="jeuxvideo")
 * @ORM\Entity
 */
class Jeuxvideo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_jeuxVideo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJeuxvideo;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="telechargements", type="integer", nullable=false)
     */
    private $telechargements;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="developpeur", type="string", length=30, nullable=false)
     */
    private $developpeur;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=30, nullable=false)
     */
    private $categorie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="note_spec", type="float", precision=10, scale=0, nullable=false)
     */
    private $noteSpec;

    /**
     * @var float
     *
     * @ORM\Column(name="note_presse", type="float", precision=10, scale=0, nullable=false)
     */
    private $notePresse;


}

