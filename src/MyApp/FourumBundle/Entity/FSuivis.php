<?php

namespace MyApp\FourumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FSuivis
 *
 * @ORM\Table(name="f_suivis", indexes={@ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id_topic", columns={"id_topic"})})
 * @ORM\Entity
 */
class FSuivis
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
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \ForumTopics
     *
     * @ORM\ManyToOne(targetEntity="ForumTopics")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_topic", referencedColumnName="id_Topics")
     * })
     */
    private $idTopic;

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
     * @return \FosUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param \FosUser $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return \ForumTopics
     */
    public function getIdTopic()
    {
        return $this->idTopic;
    }

    /**
     * @param \ForumTopics $idTopic
     */
    public function setIdTopic($idTopic)
    {
        $this->idTopic = $idTopic;
    }


}

