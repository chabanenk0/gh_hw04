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

    public function testsAction()
    {
        $testsArray = $this->getDoctrine()
            ->getRepository('chabanenk0TestAssignmentBundle:Test')
            ->findAll();

        if (!$testsArray) {
            throw $this->createNotFoundException(
                'No test record found  '
            );
        }

        return $this->render('AcmeDemoBundle:My:tests.html.twig',array('tests'=>$testsArray));
    }

    public function testViewAction($id)
    {
        return $this->render('AcmeDemoBundle:My:testview.html.twig',array(
            'id'=>$id,
        ));
    }

}
