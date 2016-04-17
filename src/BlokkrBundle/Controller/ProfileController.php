<?php

namespace BlokkrBundle\Controller;

use BlokkrBundle\Entity\Authentication\BlokkrUser;
use BlokkrBundle\Entity\Profile;
use BlokkrBundle\Form\ProfileEditType;
use BlokkrBundle\Form\ProfileNewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProfileController
 * @package BlokkrBundle\Controller
 *
 * Controller for profile actions
 */
class ProfileController extends Controller
{

    /**
     * @Route("/profile/show/{slug}", name="blokkr_profile_show", defaults={"slug": "self"})
     * @Method({"GET","HEAD"})
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showProfileAction($slug)
    {
        $currentUser = $this->get("security.token_storage")->getToken()->getUser();
        $profileService = $this->get("blokkr.service.profile");

        if ($slug === "self") {
            $profile = $currentUser->getProfile();
            // If own profile can not be found, redirect to creation page
            if ($profile === null) {
                return $this->redirectToRoute("blokkr_profile_edit", array("slug" => "self"));
            }
        } else {
            $profile = $profileService->getProfileBySlug($slug);
        }

        // 404 if profile not found
        if ($profile === null) {
            throw $this->createNotFoundException("Profile could not be found!");
        }

        return $this->render('BlokkrBundle:Profile:show.html.twig', array(
            'profile' => $profile,
            'self' => $currentUser->getProfile() !== null && $currentUser->getProfile() === $profile
        ));
    }


    /**
     * @Route("/profile/new", name="blokkr_profile_new")
     * @Method({"GET","HEAD", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newProfileAction(Request $request)
    {
        $currentUser = $this->get("security.token_storage")->getToken()->getUser();

        $profile = new Profile();
        $profile->setUser($currentUser);
        $form = $this->createForm(ProfileNewType::class, $profile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();

            $this->redirectToRoute("blokkr_profile_show", array('slug' => $profile->getShortcut()));
        }

        return $this->render('BlokkrBundle:Default:show_form.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/profile/edit/{slug}", name="blokkr_profile_edit", defaults={"slug": "self"})
     * @Method({"GET","HEAD", "POST"})
     * @param Request $request
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProfileAction(Request $request, $slug)
    {
        $currentUser = $this->get("security.token_storage")->getToken()->getUser();
        $profileService = $this->get("blokkr.service.profile");

        $profile = $profileService->getProfileBySlug($slug);
        $this->checkProfileToBeEditable($currentUser, $profile);

        // Create the form and check if it was submitted
        $form = $this->createForm(ProfileEditType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->merge($profile);
            $em->flush();

            $this->redirectToRoute("blokkr_profile_show", array('slug' => $profile->getId()));
        }

        return $this->render('BlokkrBundle:Default:show_form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function checkProfileToBeEditable(BlokkrUser $user, $profile)
    {
        if ($profile === null) {
            throw $this->createNotFoundException("This profile does not exist!");
        }

        if ($profile->getUser() === null || $user->getProfile() !== $profile) {
            throw $this->createAccessDeniedException("You are not allowed to edit this profile!");
        }
    }
}
