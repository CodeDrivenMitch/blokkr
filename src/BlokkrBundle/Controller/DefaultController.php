<?php

namespace BlokkrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="blokkr_index")
     */
    public function indexAction()
    {
        return $this->render('BlokkrBundle:Default:index.html.twig');
    }
}
