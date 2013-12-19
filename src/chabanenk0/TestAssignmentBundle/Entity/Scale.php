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
     * @ORM\Column(type="string")
     */
    protected $name = 0;


    /**
     * @ORM\ManyToOne(targetEntity="Test", inversedBy="scales",cascade={"persist"})
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     **/
    protected $testId;

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

    /**
     * @param mixed $testId
     */
    public function setTestId($testId)
    {
        $this->testId = $testId;
    }

    /**
     * @return mixed
     */
    public function getTestId()
    {
        return $this->testId;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}