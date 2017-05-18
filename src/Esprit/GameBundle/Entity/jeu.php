<?php
namespace  Esprit\GameBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Jeu
 * @package Pidev\GameBundle\Entity
 */

/**
 * @ORM\Entity(repositoryClass="Esprit\GameBundle\Repository\GameRepository")
 */

class jeu
{

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_Jeu;
    /**
     *      * @Assert\Length(
     *      min = 3,
     *      max = 40
     * )
     * @ORM\Column(type="string",length=255)
     */
    private $titre;
    /**
     *      * @Assert\Length(
     *      min = 3,
     *      max = 40
     * )
     * @ORM\Column(type="string",length=255)
     */
    private $genre;
    /**
     * @ORM\Column(name="date_sortie",type="date")
     */
    private $date_sortie;
    /**
     * @ORM\Column(type="integer")
     */
    private $note_presse;
    /**
     * @ORM\Column(type="integer")
     */
    private $note_joueur;
    /**
     *      * @Assert\Length(
     *      min = 20
     * )
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     *     * @Assert\Regex(
     *     pattern     = "/^[0-9]+$/i",
     *     htmlPattern = "^[0-9]+$"
     * )
     * @ORM\Column(type="integer")
     */
    private $prix;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $console;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $image;
    /**
     *     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$"
     * )
     * @ORM\Column(type="string",length=255)
     */
    private $developpeur;
    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
    /**
     * @return mixed
     */
    public function getIdJeu()
    {
        return $this->id_Jeu;
    }

    /**
     * @param mixed $id_Jeu
     */
    public function setIdJeu($id_Jeu)
    {
        $this->id_Jeu = $id_Jeu;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getDateSortie()
    {
        return $this->date_sortie;
    }

    /**
     * @param mixed $date_sortie
     */
    public function setDateSortie($date_sortie)
    {

        $this->date_sortie = $date_sortie;

    }

    /**
     * @return mixed
     */
    public function getNotePresse()
    {
        return $this->note_presse;
    }

    /**
     * @param mixed $note_presse
     */
    public function setNotePresse($note_presse)
    {
        $this->note_presse = $note_presse;
    }

    /**
     * @return mixed
     */
    public function getNoteJoueur()
    {
        return $this->note_joueur;
    }

    /**
     * @param mixed $note_joueur
     */
    public function setNoteJoueur($note_joueur)
    {
        $this->note_joueur = $note_joueur;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getConsole()
    {
        return $this->console;
    }

    /**
     * @param mixed $console
     */
    public function setConsole($console)
    {
        $this->console = $console;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getDeveloppeur()
    {
        return $this->developpeur;
    }

    /**
     * @param mixed $developpeur
     */
    public function setDeveloppeur($developpeur)
    {
        $this->developpeur = $developpeur;
    }


}