<?php
/**This class constructs test example with certiain questions and answers.
 * Further these data will be stored in the database;
 * Created by PhpStorm.
 * User: dmitry
 * Date: 29.10.13
 * Time: 22:03
 */

namespace chabanenk0\TestAssignmentBundle\Entity;

use chabanenk0\TestAssignmentBundle\Entity\Answer;
use chabanenk0\TestAssignmentBundle\Entity\AbstractTestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\OneCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\MultiCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\Test;
use Symfony\Component\HttpFoundation\Request;


class TestClass01 {

    protected $test;

    protected $formBuilder;

    public function __construct()
    {
        $this->test=new Test();
        $mainScale=new Scale();
        $this->test->addScale($mainScale);
        $a=new OneCaseTestQuestion();
        $a->setQuestion("2*2=?");
        $a->addAnswer(new Answer("1", array(new ScaleScore($mainScale, 0))));
        $a->addAnswer(new Answer("2", array(new ScaleScore($mainScale, 0))));
        $a->addAnswer(new Answer("3", array(new ScaleScore($mainScale, 0))));
        $a->addAnswer(new Answer("4", array(new ScaleScore($mainScale, 1))));
        $this->test->addQuestion($a);
//echo $a->askQuestion();

        $b=new MultiCaseTestQuestion();
        $b->setQuestion("5*5=?");
        $b->addAnswer(new Answer("25", array(new ScaleScore($mainScale, 1))));
        $b->addAnswer(new Answer("10", array(new ScaleScore($mainScale, 0))));
        $b->addAnswer(new Answer("5", array(new ScaleScore($mainScale, 0))));
        $b->addAnswer(new Answer("1", array(new ScaleScore($mainScale, 0))));
        $this->test->addQuestion($b);
//echo $b->askQuestion();

    }

    public function getTestForm($formBuilder)
    {
        //$questionsText = $questionsText."<input type=submit value='ok'></form>";
        $this->formBuilder = $this->test->askQuestions($formBuilder);
        $form=$this->formBuilder->getForm();

        return $form;
    }

    public function calculateScale(Request $request)
    {
        $this->test->calculateScales($request);
        $scales = $this->test->getScales();
        $scaleScoresArray=array();
        foreach ($scales as $scale) {
            $scaleScoresArray[]=$scale->getScore();
        }
        return $scaleScoresArray;
    }


    public function setTest($test)
    {
        $this->test = $test;
    }

    public function getTest()
    {
        return $this->test;
    }



} 