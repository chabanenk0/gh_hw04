<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
// using only yaml configuration
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MyController extends Controller
{
    /**
     * @Route("/first/", name="_demo2")
     * @Template()
     */
    public function firstAction()
    {
        return new Response("This is a simple response...");
    }

    /**
     * @Route("/second", name="_demo2")
     * @Template()
     */
    public function secondAction()
    {
        return $this->render('AcmeDemoBundle:My:second.html.twig');
    }

    public function thirdAction()
    {
        return $this->render('AcmeDemoBundle:My:third.html.twig');
    }

}
