<?php

namespace BlokkrBundle\Services;

use Doctrine\ORM\EntityRepository;

class ProfileService
{
    /* @var \Doctrine\ORM\EntityRepository */
    private $repository;

    function __construct(EntityRepository $entityRepository)
    {
        $this->repository = $entityRepository;
    }

    function getProfile($id)
    {
        return $this->repository->find($id);
    }
}