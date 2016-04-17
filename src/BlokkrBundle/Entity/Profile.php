<?php

namespace BlokkrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity(repositoryClass="BlokkrBundle\Repository\ProfileRepository")
 * @UniqueEntity(fields="shortcut",
 *     ignoreNull="true",
 *     message="This shortcut is already in use!",
 *     repositoryMethod="findByShortcut",
 *     groups={"create"})
 */
class Profile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="BlokkrBundle\Entity\Authentication\BlokkrUser", inversedBy="profile")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Assert\NotNull
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="shortcut", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^[a-z_0-9]*$/", message="Only numbers, lower-case letters and underscores are allowed here!")
     * @Assert\Length(min="5")
     */
    private $shortcut;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min="5")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min="10")
     */
    private $bio;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Profile
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return Profile
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set user
     *
     * @param \BlokkrBundle\Entity\Authentication\BlokkrUser $user
     *
     * @return Profile
     */
    public function setUser(\BlokkrBundle\Entity\Authentication\BlokkrUser $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BlokkrBundle\Entity\Authentication\BlokkrUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set shortcut
     *
     * @param string $shortcut
     *
     * @return Profile
     */
    public function setShortcut($shortcut)
    {
        $this->shortcut = $shortcut;

        return $this;
    }

    /**
     * Get shortcut
     *
     * @return string
     */
    public function getShortcut()
    {
        return $this->shortcut;
    }
}
