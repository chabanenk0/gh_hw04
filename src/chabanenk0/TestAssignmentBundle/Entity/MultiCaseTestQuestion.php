<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

use chabanenk0\TestAssignmentBundle\Entity\TestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\AskableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class MultiCaseTestQuestion extends AbstractTestQuestion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function askQuestion()
    {
        $resulttext= "<p class=question>Question # ".$this->number.": ".$this->question."</p>\n";
        $qnum=$this->getNumber();
        $num=0;
        foreach ($this->answers as $i) {
            $num=$num+1; // !!! Bad idea! It needs to add id to the Answer's class!!! The same for question number (fixed)
            $resulttext=$resulttext."<p><label><input type=checkbox id=$num name=ans".$i->getNumber().">";
            $resulttext=$resulttext.$i->ask();
            $resulttext=$resulttext."</label></p>\n";
        }
    return $resulttext;
    }

    public function addQuestionToForm($formBuilder)
    {
        $qnum=$this->number;
        $num=0;
        $formBuilder->add("q".$this->number,"collection",array(
            "label"=>'Question #'.$this->number.': '.$this->question,
            "read_only"=>true,
        ));

        foreach ($this->answers as $i) {
            $num=$num+1; // !!! Bad idea! It needs to add id to the Answer's class!!! The same for question number (fixed)
            $formBuilder->add("ans".$i->getNumber(),"checkbox",array(
                'value'=>$i->getNumber(),
                'label'=>$i->ask(),
                'required'  => false,
            ));
        }

        return $formBuilder;
    }


    public function calculateScore($form)
    {

        $answers=$form->getData();
        $selectedAnswers=array();
        foreach ($this->answers as $currentAnswer) {
            $answer=$answers["ans".$currentAnswer->getNumber()];
            if ($answer == 'on') {
                $currentAnswer->calcScores();
                $selectedAnswers[]=$currentAnswer;
            }
        }
        return $selectedAnswers;
    }
}
