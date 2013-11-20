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
        $testsArray = array();
        $test1 = new TestAssignment();
        $test1->setId(1);
        $test1->setName("Таблица умножения");
        $test1->setDescription("Автогенерируемый тест на знания таблицы умножения для учеников 2 класса");
        $testsArray[]=$test1;
        $test2 = new TestAssignment();
        $test2->setId(2);
        $test2->setName("Тест темперамента Айзенка");
        $test2->setDescription("Тест на определение типа темперамента Ганса Айзенка");
        $testsArray[]=$test2;
        $test3 = new TestAssignment();
        $test3->setId(3);
        $test3->setName("IQ-тест");
        $test3->setDescription("Тест на определение уровня интеллекта Ганса Айзенка № 1.");
        $testsArray[]=$test3;

        return $this->render('AcmeDemoBundle:My:tests.html.twig',array('tests'=>$testsArray));
    }

    public function testViewAction($id)
    {
        return $this->render('AcmeDemoBundle:My:testview.html.twig',array(
            'id'=>$id,
        ));
    }

}
