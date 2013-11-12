<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

class Answer
{
    protected static $totalAnswersNumber=1;

    protected $number;

    protected $scores=array();

    public function __construct ($newAnswerText, $scaleScores=0)
    {
        self::$totalAnswersNumber = self::$totalAnswersNumber + 1;
        $this->number = self::$totalAnswersNumber;
        $this->answerText=$newAnswerText;
        $this->setScores($scaleScores);
    }

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
    protected $answerText;

    public function getAnswer ()
    {
        return $this->answerText;
    }

    public function setAnswer ($answerText)
    {
        $this->answerText=$answerText;
    }

    public function ask()
    {
        return  $this->answerText;
    }
    /**
     * @param array $scores
     */
    public function setScores($scores)
    {
        $this->scores = $scores;
    }

    public function addScore($scale, $score)
    {
        if ($scale instanceof Scale)
            array_push($this->scores, new ScaleScore($scale, $score));
    }

    public function clearScores()
    {
        $this->scores=array();
    }

    public function calcScores()
    {
        foreach ($this->scores as $currentScaleScore) {
            $currentScaleScore->calculateScore();
        }

    }

    /**
     * @return array
     */
    public function getScores()
    {
        return $this->scores;
    } //array of ScaleScore objects



}
