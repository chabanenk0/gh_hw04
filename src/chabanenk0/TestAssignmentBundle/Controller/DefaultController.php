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
        $testClass = $this->getDoctrine()
            ->getRepository('chabanenk0TestAssignmentBundle:Test')
            ->findOneById($id);

        if (!$testClass) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
        }

        $formBuilder = $this->CreateFormBuilder();
        $formBuilder = $testClass->askQuestions($formBuilder);
        $form=$formBuilder->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $scalesArray = $testClass->calculateScaleArray($form);
            return $this->render("chabanenk0TestAssignmentBundle:Default:scales.html.twig",array('scales'=>$scalesArray ));
        }

        return $this->render("chabanenk0TestAssignmentBundle:Default:test.html.twig",array('form'=>$form->createView(),'id'=>$id));

        //return $this->render('chabanenk0TestAssignmentBundle:Default:index.html.twig', array('id' => $id));
    }
}
