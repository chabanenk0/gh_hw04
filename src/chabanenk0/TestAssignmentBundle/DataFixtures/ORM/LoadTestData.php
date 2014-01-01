<?php

namespace chabanenk0\TestAssignmentBundle\DataFixtures\ORM;;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use chabanenk0\TestAssignmentBundle\Entity\Test;
use chabanenk0\TestAssignmentBundle\Entity\Scale;
use chabanenk0\TestAssignmentBundle\Entity\ScaleScore;
use chabanenk0\TestAssignmentBundle\Entity\OneCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\MultiCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\Answer;
use Doctrine\Common\Collections\ArrayCollection;

class LoadTestData implements FixtureInterface
    {
        /**
         * {@inheritDoc}
         */
        public function load(ObjectManager $manager)
        {
            $test=new Test();
            $test->setTestName("Арифметический тест");
            $test->setTestDescription("Тест на проверку знаний таблицы умножения");
            $mainScale=new Scale();
            $test->addScale($mainScale);
            $a=new OneCaseTestQuestion();
            $a->setQuestion("2*2=?");
            $a->addAnswer(new Answer("1", new ScaleScore($mainScale, 0)));
            $a->addAnswer(new Answer("2", new ScaleScore($mainScale, 0)));
            $a->addAnswer(new Answer("3", new ScaleScore($mainScale, 0)));
            $a->addAnswer(new Answer("4", new ScaleScore($mainScale, 1)));
            $test->addQuestion($a);
            $b=new MultiCaseTestQuestion();
            $b->setQuestion("5*5=?");
            $b->addAnswer(new Answer("25", new ScaleScore($mainScale, 1)));
            $b->addAnswer(new Answer("10", new ScaleScore($mainScale, 0)));
            $b->addAnswer(new Answer("5", new ScaleScore($mainScale, 0)));
            $b->addAnswer(new Answer("1", new ScaleScore($mainScale, 0)));
            $test->addQuestion($b);
            $manager->persist($test);
            $manager->flush();
        }
    }

?>