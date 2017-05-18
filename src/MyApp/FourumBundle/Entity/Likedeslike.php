<?php


namespace MyApp\FourumBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Likedeslike
 *
 * @ORM\Table(name="likedeslike", indexes={@ORM\Index(name="idcommentaire", columns={"idcommentaire"}), @ORM\Index(name="idtopic", columns={"idtopic"}), @ORM\Index(name="idmembre", columns={"idmembre"})})
 * @ORM\Entity
 */
class Likedeslike
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
     * @var integer
     *
     * @ORM\Column(name="idcommentaire", type="integer", nullable=false)
     */
    private $idcommentaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="idtopic", type="integer", nullable=false)
     */
    private $idtopic;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmembre", referencedColumnName="id")
     * })
     */
    private $idmembre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="liked", type="boolean", nullable=false)
     */
    private $liked;

    /**
     * @var boolean
     *
     * @ORM\Column(name="desliked", type="boolean", nullable=false)
     */
    private $desliked;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdcommentaire()
    {
        return $this->idcommentaire;
    }

    /**
     * @param int $idcommentaire
     */
    public function setIdcommentaire($idcommentaire)
    {
        $this->idcommentaire = $idcommentaire;
    }

    /**
     * @return int
     */
    public function getIdtopic()
    {
        return $this->idtopic;
    }

    /**
     * @param int $idtopic
     */
    public function setIdtopic($idtopic)
    {
        $this->idtopic = $idtopic;
    }

    /**
     * @return int
     */
    public function getIdmembre()
    {
        return $this->idmembre;
    }

    /**
     * @param int $idmembre
     */
    public function setIdmembre($idmembre)
    {
        $this->idmembre = $idmembre;
    }

    /**
     * @return bool
     */
    public function isLiked()
    {
        return $this->liked;
    }

    /**
     * @param bool $liked
     */
    public function setLiked($liked)
    {
        $this->liked = $liked;
    }

    /**
     * @return bool
     */
    public function isDesliked()
    {
        return $this->desliked;
    }

    /**
     * @param bool $desliked
     */
    public function setDesliked($desliked)
    {
        $this->desliked = $desliked;
    }


}

