<?php

namespace chabanenk0\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use chabanenk0\BlogBundle\Form\ContactType;
use chabanenk0\BlogBundle\Form\TestAssignmentType;

// these import the "@Route" and "@Template" annotations
// using only yaml configuration
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chabanenk0\BlogBundle\Entity\TestAssignment;
use chabanenk0\TestAssignmentBundle\Entity\Test;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class TestAssignmentController extends Controller
{

    public function aboutAction()
    {
        return $this->render('chabanenk0BlogBundle:TestAssignment:message.html.twig',array(
            'title'=>'Про нас',
            'header'=>'Про нас',
            'message'=>'Мене звати Дмитро Чабаненко. Даний сайт розроблений особисто мною у рамках проекту GeekHub Advanced PHP 2013-14 року.',
        ));
    }

    public function contactsAction()
    {
        return $this->render('chabanenk0BlogBundle:TestAssignment:message.html.twig',array(
            'title'=>'Контакти',
            'header'=>'Контакти',
            'message'=>'Дмитро Чабаненко. mailto:chdn6026@mail.ru, icq:345243743, skype:dmitry_chabanenko Буду радий будь-яким критичним побажанням.',
        ));
    }

    public function testsAction($id=-1, $page =  null)
    {
        
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('chabanenk0BlogBundle:Tag')->findOneById($id);
        if ($tag) {
            $dql   = "SELECT t FROM chabanenk0BlogBundle:TestAssignment t where :tag member of t.tags";
            $query = $em->createQuery($dql);
            $query->setParameter('tag', $tag);

        }
        else {
            $dql   = "SELECT a FROM chabanenk0BlogBundle:TestAssignment a";
            $query = $em->createQuery($dql);
            //$testsArray=$tag->getTests();
        }
        //$query->setMaxResults(5);
        //$testsArray=$query->getResult();
        //$testsArray = $this->getDoctrine()
            //->getRepository('AcmeDemoBundle:TestAssignment')
            //->findAll();
        $adapter = new DoctrineORMAdapter($query);
        $pager =  new Pagerfanta($adapter);
        $pager->setMaxPerPage(10);
        if (!$page)    $page = 1;
        try  {
            $pager->setCurrentPage($page);
        }
        catch(NotValidCurrentPageException $e) {
            throw new NotFoundHttpException('Illegal page');
        }
        if ($pager->hasNextPage()) {
            $nexPageNumber=$page + 1;
        }
        else $nexPageNumber=null;

        return $this->render('chabanenk0BlogBundle:TestAssignment:tests.html.twig',array(
            //'tests'=>$testsArray,
            'pager'=>$pager,
            'nextpage'=>$nexPageNumber,
            'tagId'=>$id,
            ));
    }

    public function testsPagerAction($id=-1, $page =  null)
    {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('chabanenk0BlogBundle:Tag')->findOneById($id);
        if ($tag) {
            $dql   = "SELECT t FROM chabanenk0BlogBundle:TestAssignment t where :tag member of t.tags";
            $query = $em->createQuery($dql);
            $query->setParameter('tag', $tag);

        }
        else {
            $dql   = "SELECT a FROM chabanenk0BlogBundle:TestAssignment a";
            $query = $em->createQuery($dql);
            //$testsArray=$tag->getTests();
        }
        //$query->setMaxResults(5);
        //$testsArray=$query->getResult();
        //$testsArray = $this->getDoctrine()
            //->getRepository('AcmeDemoBundle:TestAssignment')
            //->findAll();
        
        $adapter = new DoctrineORMAdapter($query);
        $pager =  new Pagerfanta($adapter);
        $pager->setMaxPerPage(10);
        if (!$page)    $page = 1;
        try  {
            $pager->setCurrentPage($page);
        }
        catch(NotValidCurrentPageException $e) {
            throw new NotFoundHttpException('Illegal page');
        }
        
        if ($pager->hasNextPage()) {
            $nexPageNumber=$page + 1;
        }
        else $nexPageNumber=null;

        return $this->render('chabanenk0BlogBundle:TestAssignment:tests_pager.html.twig',array(
            //'tests'=>$testsArray,
            'pager'=>$pager,
            'nextpage'=>$nexPageNumber,
            'tagId'=>$id,
            ));
    }

    public function testViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('chabanenk0BlogBundle:TestAssignment')->findOneById($id);
        $test->increaseVisits();
        $testId=$test->getTestId();
        $em->persist($test);
        $em->flush();


        return $this->render('chabanenk0BlogBundle:TestAssignment:testview.html.twig',array(
            'id'=>$testId,
        ));
    }

    public function latestTestsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM chabanenk0BlogBundle:TestAssignment a order by a.dateTimeUploaded desc";
        $query = $em->createQuery($dql);
            //$testsArray=$tag->getTests();
        
        $query->setMaxResults(5);
        $testsArray=$query->getResult();

        if (!$testsArray) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
        }

        return $this->render('chabanenk0BlogBundle:TestAssignment:testLinksList.html.twig',array('tests'=>$testsArray));
    }
    public function popularTestsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM chabanenk0BlogBundle:TestAssignment a order by a.visits desc";
        $query = $em->createQuery($dql);
            //$testsArray=$tag->getTests();
        
        $query->setMaxResults(5);
        $testsArray=$query->getResult();

        if (!$testsArray) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
        }

        return $this->render('chabanenk0BlogBundle:TestAssignment:testLinksList.html.twig',array('tests'=>$testsArray));
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

        return $this->render("chabanenk0BlogBundle:TestAssignment:newtest.html.twig",array('form'=>$form->createView()));
    }
}
