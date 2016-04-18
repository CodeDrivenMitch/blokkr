<?php

namespace BlokkrBundle\Twig\Extension;

use BlokkrBundle\Entity\Authentication\BlokkrUser;

class ProfileSlugExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('profile_slug', array($this, 'slugFilter')),
        );
    }

    public function slugFilter(BlokkrUser $user)
    {
        if($user->getProfile() === null) {
            return "new";
        }
        return $user->getProfile()->getShortcut();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'profile_slug';
    }
}
