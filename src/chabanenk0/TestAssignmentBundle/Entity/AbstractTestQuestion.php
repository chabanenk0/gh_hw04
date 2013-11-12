<?php
//require_once("AskableInterface.php");
//require_once("CheckableInterface.php");
//require_once("Answer.php");

namespace chabanenk0\TestAssignmentBundle\Entity;

use chabanenk0\TestAssignmentBundle\Entity\Answer;

abstract class AbstractTestQuestion implements AskableInterface
{
    protected static $totalQuestionsNumber; // doesn't work. It is not a global property

    protected $number;

    protected $numberOfAnswers;

    protected $question;

    protected $answers; // should be an array of Answer's objects

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    public function __construct()
    {
        $this->answers=array();
        self::$totalQuestionsNumber = self::$totalQuestionsNumber+1;
        $this->number=self::$totalQuestionsNumber;
        $this->numberOfAnswers=0;
    }

    abstract public function askQuestion();

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($q)
    {
        $this->question=$q;
    }

    public function clearAnswers()
    {
        $this->answers=array();
        $numberOfAnswers=0;
    }

    public function addAnswer($answer) // for input as Answer class
    {
        $this->numberOfAnswers = $this->numberOfAnswers + 1;
        if ($answer instanceof Answer) {
            array_push($this->answers, $answer);
        }
        elseif (is_string($answer)) {
            $ans=new Answer($answer);
            array_push($this->answers, $ans);
        }
        else {
            die ("Wrong type for method addAnswer");// it needs to add exceptions...
        }

    }
    public function addAnswerString(string $answer) // for input as string
    {
        $ans=new Answer("");
        $this->numberOfAnswers=$this->numberOfAnswers+1;
        $ans->setAnswer($answer);
        array_push($this->answers, $ans);
    }
}
