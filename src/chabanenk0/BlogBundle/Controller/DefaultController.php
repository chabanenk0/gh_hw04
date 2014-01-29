<?php

namespace chabanenk0\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('chabanenk0BlogBundle:Default:index.html.twig', array('name' => $name));
    }

    public function indexPageAction()
    {
        return $this->render('chabanenk0BlogBundle:Default:indexPage.html.twig');
    }


}
