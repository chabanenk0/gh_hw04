<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use chabanenk0\TestAssignmentBundle\Entity\TestClass01;
use Symfony\Component\HttpFoundation\Request;
use chabanenk0\TestAssignmentBundle\Entity\OpenEvent;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $dispatcher = $this->container->get('event_dispatcher');
        $myservice = $this->container->get("chabanenk0_test_assignment.example");
        $event = new OpenEvent();
        $dispatcher -> dispatch("chabtest.opentest",$event);
        //var_dump("after first event");
        //var_dump($myservice);
        //$myservice->onOpenAction($event);
        //var_dump("after first event direct dispatch");
        $id=$request->get('id');
        $testClass = $this->getDoctrine()
            ->getRepository('chabanenk0TestAssignmentBundle:Test')
            ->findOneById($id);

        if (!$testClass) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
            $dispatcher -> dispatch("chabtest.opentest",new OpenEvent($id,"TestNotFound"));
        }

        $formBuilder = $this->CreateFormBuilder();
        $formBuilder = $testClass->askQuestions($formBuilder);
        $form=$formBuilder->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $scalesArray = $testClass->calculateScaleArray($form);
            $dispatcher -> dispatch("chabtest.opentest",new OpenEvent($id,"TestSubmitted"));
            return $this->render("chabanenk0TestAssignmentBundle:Default:scales.html.twig",array('scales'=>$scalesArray ));
        }
        $dispatcher -> dispatch("chabtest.opentest",new OpenEvent($id,"TestRequested"));

        return $this->render("chabanenk0TestAssignmentBundle:Default:test.html.twig",array('form'=>$form->createView(),'id'=>$id));

        //return $this->render('chabanenk0TestAssignmentBundle:Default:index.html.twig', array('id' => $id));
    }
}
