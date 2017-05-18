<?php
/**
 * Created by PhpStorm.
 * User: slimu
 * Date: 09/04/2017
 * Time: 02:49
 */
namespace Esprit\GameBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Views
 * @package Pidev\GameBundle\Entity
 */

/**
 * @ORM\Entity
 */


class Views
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $view;
    /**
     * @ORM\ManyToOne(targetEntity="jeu")
     * @ORM\JoinColumn(name="jeu_id", referencedColumnName="id_jeu")
     */
    private $jeu;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $view
     */
    public function setView($view)
    {
        $this->view = $view;
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

}