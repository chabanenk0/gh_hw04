<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($id)
    {

        return $this->render('chabanenk0TestAssignmentBundle:Default:index.html.twig', array('id' => $id));
    }
}
