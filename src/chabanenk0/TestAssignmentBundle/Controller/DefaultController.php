<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use chabanenk0\TestAssignmentBundle\Entity\TestClass01;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $id=$request->get('id');
        switch ($id) {
            case 1:
                $testclass = new TestClass01();
                break;
            case 2:
                $testclass = new TestClass01();
                break;
            case 3:
                $testclass = new TestClass01();
                break;
            default:
                $testclass = new TestClass01();
                break;

        }

        $formBuilder = $this->CreateFormBuilder();
        $form=$testclass->getTestForm($formBuilder);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $scalesArray = $testclass->calculateScale($request);
            return $this->render("chabanenk0TestAssignmentBundle:Default:scales.html.twig",array('scales'=>$scalesArray ));
        }


        return $this->render("chabanenk0TestAssignmentBundle:Default:test.html.twig",array('form'=>$form->createView(),'id'=>$id));

        //return $this->render('chabanenk0TestAssignmentBundle:Default:index.html.twig', array('id' => $id));
    }
}
