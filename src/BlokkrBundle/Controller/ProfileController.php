<?php

namespace BlokkrBundle\Controller;

use Doctrine\DBAL\Migrations\AbortMigrationException;
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
     * @Route("/profile/{slug}", name="blokkr_profile_id", defaults={"slug": "self"})
     * @Method({"GET","HEAD"})
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showProfileAction($slug)
    {
        $currentUser = $this->get("security.token_storage")->getToken()->getUser();
        $profileService = $this->get("blokkr.service.profile");

        if($slug === "self") {
            $profile = $currentUser->getProfile();
            // If own profile can not be found, redirect to creation page
            if($profile === null) {
//                return $this->redirectToRoute("blokkr_profile_edit", array("slug" => "self"));
            }
        } else {
            $profile = $profileService->getProfileBySlug($slug);
        }

        // 404 if profile not found
        if($profile === null) {
            throw $this->createNotFoundException("Profile could not be found!");
        }

        return $this->render('BlokkrBundle:Profile:show.html.twig', array(
            'profile' => null,
            'self' => $currentUser->getProfile() !== null && $currentUser->getProfile() ===$profile
        ));
    }

    /**
     * @Route("/profile/{slug}/edit", name="blokkr_profile_edit", defaults={"slug": "self"})
     * @Method({"GET","HEAD"})
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProfileAction($slug) {
        throw $this->createNotFoundException();
    }
}
