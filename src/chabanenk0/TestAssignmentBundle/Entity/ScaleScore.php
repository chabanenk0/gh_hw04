<?php
/**
 * This class connects scale with some score for right or wrong answer
 * The array of objects of this class are used in the Answer objects
 * Created by PhpStorm.
 * User: dmitry
 * Date: 29.10.13
 * Time: 22:51
 */

namespace chabanenk0\TestAssignmentBundle\Entity;


class ScaleScore {
    protected $scale;

    protected $score; //double

    public function __construct($scale, $score)
    {
        $this->scale=$scale;
        $this->score=$score;
    }

    /**
     * @param mixed $scale
     */
    public function setScale($scale)
    {
        if ($scale instanceof Scale )
            $this->scale = $scale;
    }

    /**
     * @return mixed
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    public function calculateScore()
    {
        $this->scale->increaseScore($this->score);
    }
}