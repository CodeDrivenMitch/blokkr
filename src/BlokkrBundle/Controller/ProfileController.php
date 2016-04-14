<?php

namespace BlokkrBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ProfileController
 * @package BlokkrBundle\Controller
 *
 * Controller for profile actions
 */
class ProfileController extends Controller
{
    /**
     * @Route("/profile/{userId}", name="blokkr_profile", defaults={"userId": -1}, requirements={
     *     "userId": "\d+"
     * })
     * @Method({"GET","HEAD"})
     */
    public function showAction()
    {

    }
}
