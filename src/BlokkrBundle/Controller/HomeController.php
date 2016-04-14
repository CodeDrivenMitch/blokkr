<?php

namespace BlokkrBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class HomeController
 * @package BlokkrBundle\Controller
 *
 * Controls the homepage
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="blokkr_index")
     * @Method({"GET","HEAD"})
     */
    public function indexAction()
    {
        return $this->render('BlokkrBundle:Home:index.html.twig');
    }
}
