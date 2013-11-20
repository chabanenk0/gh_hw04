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
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="scales")
 */
class Scale
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
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


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return Scale
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }
}