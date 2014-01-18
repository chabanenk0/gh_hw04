<?php

namespace chabanenk0\GuestbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('chabanenk0GuestbookBundle:Default:index.html.twig', array('name' => $name));
    }
}
