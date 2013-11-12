<?php
/**
 * this class is a scale, that can count the right or wrong answers, according to the certain scale
 * You can use many scales for any answer in the test.
 * Created by PhpStorm.
 * User: dmitry
 * Date: 29.10.13
 * Time: 22:43
 */

namespace chabanenk0\TestAssignmentBundle\Entity;


class Scale {
    protected $score = 0;

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    public function resetScore()
    {
        $this->score=0;
    }

    // $amount - the value of the right or wrong answer in the test
    public function increaseScore($amount)
    {
        $this->score = $this->score + $amount;
    }

} 