<?php

//require_once("AbstractTestQuestion.php");

namespace chabanenk0\TestAssignmentBundle\Entity;

use chabanenk0\TestAssignmentBundle\Entity\TestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\AskableInterface;
use chabanenk0\TestAssignmentBundle\Entity\ScalableInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class OneCaseTestQuestion extends AbstractTestQuestion implements AskableInterface, ScalableInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function askQuestion()
    {
        $resulttext= "<p class=question>Question # ".$this->number.": ".$this->question."</p>\n";
        $qnum=$this->number;
        $num=0;
        foreach ($this->answers as $i) {
            $num=$num+1; // !!! Bad idea! It needs to add id to the Answer's class!!! The same for question number (fixed)
            $resulttext=$resulttext."<p><label><input type=radio id=$num name=ans$qnum value=".$i->getNumber().">";
            $resulttext=$resulttext.$i->ask();
            $resulttext=$resulttext."</label></p>\n";
        }
        return $resulttext;
    }

    public function addQuestionToForm($formBuilder)
    {
        $qnum=$this->number;
        $num=0;
        $choices=array();

        foreach ($this->answers as $i) {
            $num=$num+1; // !!! Bad idea! It needs to add id to the Answer's class!!! The same for question number (fixed)
            $choices[$i->getNumber()]=$i->ask();
        }
        $formBuilder->add("ans".$this->number,"choice",array(
            "choices"=>$choices,
            "expanded"=>true,
            "multiple"=>false,
            'label'=>'Question #'.$this->number.': '.$this->question,
        ));


        return $formBuilder;
    }


    public function calculateScore($form)
    {
        $data=$form->getData();
        $answer=$data["ans".$this->number];
        foreach ($this->answers as $currentAnswer) {
            if ($currentAnswer->getNumber() == $answer) {
                $currentAnswer->calcScores();
            }
        }
    }


}
