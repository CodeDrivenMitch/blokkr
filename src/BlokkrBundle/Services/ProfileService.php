<?php

namespace BlokkrBundle\Services;

use BlokkrBundle\Repository\ProfileRepository;
use Doctrine\ORM\EntityRepository;

class ProfileService
{
    /* @var ProfileRepository */
    private $repository;

    function __construct(EntityRepository $entityRepository)
    {
        $this->repository = $entityRepository;
    }

    function getProfileBySlug($slug) {
        if(is_numeric($slug)) {
            return $this->getProfileById($slug);
        } else {
            return $this->getProfileByShortcut($slug);
        }
    }

    function getProfileById($id)
    {
        return $this->repository->find($id);
    }

    function getProfileByShortcut($shortcut) {
        return $this->repository->findByShortcut($shortcut);
    }
}