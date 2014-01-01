<?php
//require_once("AskableInterface.php");
//require_once("CheckableInterface.php");
//require_once("Answer.php");

namespace chabanenk0\TestAssignmentBundle\Entity;

use chabanenk0\TestAssignmentBundle\Entity\Answer;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="questionType", type="string")
 * @ORM\DiscriminatorMap({"one" = "OneCaseTestQuestion", "multi" = "MultiCaseTestQuestion"})
 * @ORM\Table(name="questions")
 */
abstract class AbstractTestQuestion implements AskableInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Test", inversedBy="questions")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     */
    protected $testId;

    protected static $totalQuestionsNumber; // doesn't work. It is not a global property

    /**
     * @ORM\Column(type="integer")
     */
    protected $number;

   /**
    * @ORM\Column(type="integer")
    */
    protected $numberOfAnswers;

    /**
     * @ORM\Column(type="text")
     */
    protected $question;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="questionID",cascade={"persist"})
     */
    protected $answers; // should be an array of Answer's objects


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
        $this->answers=new ArrayCollection();
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
            $answer->setQuestionID($this);
            $this->answers->add($answer);
        }
        elseif (is_string($answer)) {
            $ans=new Answer($answer);
            $ans->setQuestionID($this);
            $this->answers->add($ans);
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
        $ans->setQuestionID($this);
        $this->answers->add($ans);
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
     * Set numberOfAnswers
     *
     * @param integer $numberOfAnswers
     * @return AbstractTestQuestion
     */
    public function setNumberOfAnswers($numberOfAnswers)
    {
        $this->numberOfAnswers = $numberOfAnswers;
    
        return $this;
    }

    /**
     * Get numberOfAnswers
     *
     * @return integer 
     */
    public function getNumberOfAnswers()
    {
        return $this->numberOfAnswers;
    }

    /**
     * Remove answers
     *
     * @param \chabanenk0\TestAssignmentBundle\Entity\Answer $answers
     */
    public function removeAnswer(\chabanenk0\TestAssignmentBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}