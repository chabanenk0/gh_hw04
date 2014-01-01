<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use chabanenk0\TestAssignmentBundle\Entity\TestClass01;
use chabanenk0\TestAssignmentBundle\Entity\User;
use chabanenk0\TestAssignmentBundle\Entity\Test;
use chabanenk0\TestAssignmentBundle\Entity\AnswerRecord;
use chabanenk0\TestAssignmentBundle\Form\UserType;
use chabanenk0\TestAssignmentBundle\Form\TestType;
use Symfony\Component\HttpFoundation\Request;
use chabanenk0\TestAssignmentBundle\Entity\OpenEvent;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $request->setLocale('ru');
        $dispatcher = $this->container->get('event_dispatcher');
        //$myservice = $this->container->get("chabanenk0_test_assignment.example");
        $event = new OpenEvent();
        $dispatcher -> dispatch("chabtest.opentest",$event);
        //var_dump("after first event");
        //var_dump($myservice);
        //$myservice->onOpenAction($event);
        //var_dump("after first event direct dispatch");
        $id=$request->get('id');
        $userId=1;//!!!temporary. Should be corrected after implementin sequrity issues!!!
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
            $testClass->resetScales();
            $resultScalesAnswers = $testClass->calculateScaleArray($form);
            $scalesArray = $resultScalesAnswers['scales'];
            $answersArray = $resultScalesAnswers['answers'];
            $currentUser = $this->getDoctrine()
            ->getRepository('chabanenk0TestAssignmentBundle:User')
            ->findOneById($userId);
            $newAnswerRecord = new AnswerRecord($currentUser,$scalesArray,$answersArray);
            $newAnswerRecord -> setTest($testClass);
            $em =  $this -> getDoctrine()->getManager();
            $em -> persist($newAnswerRecord);
            $em -> flush();
            $dispatcher -> dispatch("chabtest.opentest", new OpenEvent($id,"TestSubmitted"));

            return $this->render("chabanenk0TestAssignmentBundle:Default:scales.html.twig",array('scales'=>$scalesArray ));
        }
        $dispatcher -> dispatch("chabtest.opentest",new OpenEvent($id,"TestRequested"));

        return $this->render("chabanenk0TestAssignmentBundle:Default:test.html.twig",array('form'=>$form->createView(),'id'=>$id));

        //return $this->render('chabanenk0TestAssignmentBundle:Default:index.html.twig', array('id' => $id));
    }

    public function newUserAction(Request $request)
    {
        $user =  new User();

        $form = $this->CreateForm(new UserType(), $user);


        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $em =  $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl("_index"));
        }

        return $this->render("chabanenk0TestAssignmentBundle:Default:newuser.html.twig",array('form'=>$form->createView()));
    }

    public function newTestAction(Request $request)
    {
        $test =  new Test();

        $form = $this->CreateForm(new TestType(), $test);


        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $em =  $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();
            return $this->redirect($this->generateUrl("_index"));
        }

        return $this->render("chabanenk0TestAssignmentBundle:Default:newtest.html.twig",array('form'=>$form->createView()));
    }

}
