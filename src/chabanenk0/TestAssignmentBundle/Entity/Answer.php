<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="answers")
 */
class Answer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\ManyToMany(targetEntity="AnswerRecord")
     * @ORM\JoinTable(name="answer_record_answers", 
     *      joinColumns={@ORM\JoinColumn(name="id", referencedColumnName="answers")})
     *      inverseJoinColumns={@ORM\JoinColumn(name="answers", referencedColumnName="id")},
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AbstractTestQuestion", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    protected $questionID;


    protected static $totalAnswersNumber=1;

    /**
     * @ORM\Column(type="integer")
     */
    protected $number;

    /**
     * @ORM\OneToMany(targetEntity="ScaleScore", mappedBy="answer",cascade={"persist"})
     */
    protected $scores;

    /**
     * @ORM\Column(type="text")
     */
    protected $answerText;

    public function __construct ($newAnswerText, $scaleScore)
    {
        self::$totalAnswersNumber = self::$totalAnswersNumber + 1;
        $this->number = self::$totalAnswersNumber;
        $this->answerText=$newAnswerText;
        $scaleScore->setAnswer($this);
        $this->setScores(new ArrayCollection(array($scaleScore)));
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
        if ($scale instanceof Scale) {
            $newScaleScore = new ScaleScore($scale, $score);
            $newScaleScore->setAnswer($this);
            $this->scores->add($newScaleScore);
        }
    }

    public function clearScores()
    {
        $this->scores=new ArrayCollection();
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
     * Remove scores
     *
     * @param \chabanenk0\TestAssignmentBundle\Entity\ScaleScore $scores
     */
    public function removeScore(\chabanenk0\TestAssignmentBundle\Entity\ScaleScore $scores)
    {
        $this->scores->removeElement($scores);
    }

    /**
     * @param mixed $questionID
     */
    public function setQuestionID($questionID)
    {
        $this->questionID = $questionID;
    }

    /**
     * @return mixed
     */
    public function getQuestionID()
    {
        return $this->questionID;
    }


}