<?php

namespace Esprit\GameBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Jeu
 * @package Pidev\GameBundle\Entity
 */

/**
 * @ORM\Entity(repositoryClass="Esprit\GameBundle\Repository\AstuceRepository")
 */

class astuce
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_astuce;
    /**
     *      * @Assert\Length(
     *      min = 3,
     *      max = 40
     * )
     * @ORM\Column(type="string",length=255)
     */
    private $title_astuce;
    /**
     *      * @Assert\Length(
     *      min = 20
     * )
     * @ORM\Column(type="text")
     */
    private $description_astuce;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $image_astuce;
    /**
     * @ORM\ManyToOne(targetEntity="jeu")
     * @ORM\JoinColumn(name="jeu_id", referencedColumnName="id_jeu")
     */
    private $jeu;

    /**
     * @return mixed
     */
    public function getIdAstuce()
    {
        return $this->id_astuce;
    }

    /**
     * @param mixed $id_astuce
     */
    public function setIdAstuce($id_astuce)
    {
        $this->id_astuce = $id_astuce;
    }

    /**
     * @return mixed
     */
    public function getTitleAstuce()
    {
        return $this->title_astuce;
    }

    /**
     * @param mixed $title_astuce
     */
    public function setTitleAstuce($title_astuce)
    {
        $this->title_astuce = $title_astuce;
    }

    /**
     * @return mixed
     */
    public function getDescriptionAstuce()
    {
        return $this->description_astuce;
    }

    /**
     * @param mixed $description_astuce
     */
    public function setDescriptionAstuce($description_astuce)
    {
        $this->description_astuce = $description_astuce;
    }


    /**
     * @return mixed
     */
    public function getJeu()
    {
        return $this->jeu;
    }

    /**
     * @param mixed $jeu
     */
    public function setJeu($jeu)
    {
        $this->jeu = $jeu;
    }

    /**
     * @return mixed
     */
    public function getImageAstuce()
    {
        return $this->image_astuce;
    }

    /**
     * @param mixed $image_astuce
     */
    public function setImageAstuce($image_astuce)
    {
        $this->image_astuce = $image_astuce;
    }




}
