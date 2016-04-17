<?php

namespace BlokkrBundle\Entity\Authentication;

use BlokkrBundle\Entity\Profile;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blokkr_user")
 */
class BlokkrUser extends BaseUser
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
        // your own logic
    }

    /**
     * @ORM\OneToOne(targetEntity="BlokkrBundle\Entity\Profile", mappedBy="user")
     */
    private $profile;

    /**
     * Set profile
     *
     * @param Profile $profile
     *
     * @return BlokkrUser
     */
    public function setProfile(Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
