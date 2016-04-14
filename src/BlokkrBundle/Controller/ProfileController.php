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
     * @param $userId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($userId)
    {
        $profileService = $this->get("blokkr.service.profile");
        $profile = $profileService->getProfile($userId);
        if(!$profile) {
            throw $this->createNotFoundException("This profile does not exist!");
        }

        return $this->render('BlokkrBundle:Profile:show.html.twig');
    }
}
