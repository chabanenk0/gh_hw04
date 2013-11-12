<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

use chabanenk0\TestAssignmentBundle\Entity\TestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\AskableInterface;

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

    public function calculateScore($request)
    {

        foreach ($this->answers as $currentAnswer) {
            $answer=$request->get("ans".$currentAnswer->getNumber());
            if ($answer == 'on') {
                $currentAnswer->calcScores();
            }
        }
    }
}
