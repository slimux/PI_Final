<?php

namespace MyApp\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
    * @ORM\OneToMany(targetEntity="MyApp\PIBundle\Entity\Commandes", mappedBy="utilisateur", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $commandes;

    /**
    * @ORM\OneToMany(targetEntity="MyApp\PIBundle\Entity\UtilisateursAdresses", mappedBy="utilisateur", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $adresses;

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $commandes
     */
    public function setCommandes($commandes)
    {
        $this->commandes = $commandes;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $adresses
     */
    public function setAdresses($adresses)
    {
        $this->adresses = $adresses;
    }

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
     * Add commande
     *
     * @param \MyApp\PIBundle\Entity\Commandes $commande
     *
     * @return User
     */
    public function addCommande(\MyApp\PIBundle\Entity\Commandes $commande)
    {
        $this->commandes[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \MyApp\PIBundle\Entity\Commandes $commande
     */
    public function removeCommande(\MyApp\PIBundle\Entity\Commandes $commande)
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Add adress
     *
     * @param \MyApp\PIBundle\Entity\UtilisateursAdresses $adress
     *
     * @return User
     */
    public function addAdress(\MyApp\PIBundle\Entity\UtilisateursAdresses $adress)
    {
        $this->adresses[] = $adress;

        return $this;
    }

    /**
     * Remove adress
     *
     * @param \MyApp\PIBundle\Entity\UtilisateursAdresses $adress
     */
    public function removeAdress(\MyApp\PIBundle\Entity\UtilisateursAdresses $adress)
    {
        $this->adresses->removeElement($adress);
    }
}
