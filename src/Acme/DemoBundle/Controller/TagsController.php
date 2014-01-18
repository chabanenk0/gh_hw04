<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
// using only yaml configuration
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\TestAssignment;

class TagsController extends Controller
{

    public function tagsAction()
    {
        $tagsArray = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Tag')
            ->findAll();

        if (!$tagsArray) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
        }

        return $this->render('AcmeDemoBundle:Tags:tagsList.html.twig',array('tags'=>$tagsArray));
    }
}
