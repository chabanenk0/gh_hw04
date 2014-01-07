<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;
use Acme\DemoBundle\Form\TestAssignmentType;

// these import the "@Route" and "@Template" annotations
// using only yaml configuration
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\TestAssignment;
use chabanenk0\TestAssignmentBundle\Entity\Test;

class MyController extends Controller
{
    /**
     * @Route("/", name="_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }


    public function firstAction()
    {
        return new Response("This is a simple response...");
    }

    public function secondAction()
    {
        return $this->render('AcmeDemoBundle:My:second.html.twig');
    }

    public function thirdAction()
    {
        return $this->render('AcmeDemoBundle:My:third.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('AcmeDemoBundle:My:message.html.twig',array(
            'title'=>'Про нас',
            'header'=>'Про нас',
            'message'=>'Мене звати Дмитро Чабаненко. Даний сайт розроблений особисто мною у рамках проекту GeekHub Advanced PHP 2013-14 року.',
        ));
    }

    public function contactsAction()
    {
        return $this->render('AcmeDemoBundle:My:message.html.twig',array(
            'title'=>'Контакти',
            'header'=>'Контакти',
            'message'=>'Дмитро Чабаненко. mailto:chdn6026@mail.ru, icq:345243743, skype:dmitry_chabanenko Буду радий будь-яким критичним побажанням.',
        ));
    }

    public function testsAction($id=-1)
    {
        
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('AcmeDemoBundle:Tag')->findOneById($id);
        if ($tag) {
            $dql   = "SELECT t FROM AcmeDemoBundle:TestAssignment t where :tag member of t.tags";
            $query = $em->createQuery($dql);
            $query->setParameter('tag', $tag);

        }
        else {
            $dql   = "SELECT a FROM AcmeDemoBundle:TestAssignment a";
            $query = $em->createQuery($dql);
            //$testsArray=$tag->getTests();
        }
        $query->setMaxResults(5);
        $testsArray=$query->getResult();
        //$testsArray = $this->getDoctrine()
            //->getRepository('AcmeDemoBundle:TestAssignment')
            //->findAll();

        if (!$testsArray) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
        }

        return $this->render('AcmeDemoBundle:My:tests.html.twig',array('tests'=>$testsArray));
    }

    public function testViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('AcmeDemoBundle:TestAssignment')->findOneById($id);
        $test->increaseVisits();
        $testId=$test->getTestId();
        $em->persist($test);
        $em->flush();


        return $this->render('AcmeDemoBundle:My:testview.html.twig',array(
            'id'=>$testId,
        ));
    }

    public function latestTestsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM AcmeDemoBundle:TestAssignment a order by a.dateTimeUploaded desc";
        $query = $em->createQuery($dql);
            //$testsArray=$tag->getTests();
        
        $query->setMaxResults(5);
        $testsArray=$query->getResult();

        if (!$testsArray) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
        }

        return $this->render('AcmeDemoBundle:My:testLinksList.html.twig',array('tests'=>$testsArray));
    }
    public function popularTestsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM AcmeDemoBundle:TestAssignment a order by a.visits desc";
        $query = $em->createQuery($dql);
            //$testsArray=$tag->getTests();
        
        $query->setMaxResults(5);
        $testsArray=$query->getResult();

        if (!$testsArray) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
        }

        return $this->render('AcmeDemoBundle:My:testLinksList.html.twig',array('tests'=>$testsArray));
    }

    public function newTestAction(Request $request)
    {
        $test =  new TestAssignment();

        $form = $this->CreateForm(new TestAssignmentType(), $test);


        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $em =  $this->getDoctrine()->getManager();
            $testObject = new Test();
            $testObject->setTestName($test->getName());
            $testObject->setTestDescription($test->getDescription());
            $test->setTest($testObject);

            $em->persist($test);
            $em->flush();

            if ($form['image']) {
                $someNewFilename = $test->getId().".jpg";
                $form['image']->getData()->move("./bundles/acmedemo/images/", $someNewFilename);
                $test->setImage("./bundles/acmedemo/images/".$someNewFilename);
                $em->persist($test);
                $em->flush();
            }

            return $this->redirect($this->generateUrl("_tests"));
        }

        return $this->render("AcmeDemoBundle:My:newtest.html.twig",array('form'=>$form->createView()));
    }

}
