<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use chabanenk0\TestAssignmentBundle\Entity\TestClass01;

class DefaultController extends Controller
{
    public function indexAction($id)
    {

        $testclass = new TestClass01();
        $formBuilder = $this->CreateFormBuilder();
        $form=$testclass->getTestForm($formBuilder);

        return $this->render("chabanenk0TestAssignmentBundle:Default:test.html.twig",array('form'=>$form->createView()));

        //return $this->render('chabanenk0TestAssignmentBundle:Default:index.html.twig', array('id' => $id));
    }
}
