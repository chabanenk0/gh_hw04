<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="answers_records")
 */
class AnswerRecord
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Test")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     */
    protected $test;


    /**
     * @ORM\ManyToMany(targetEntity="Answer",cascade={"persist"})
     * @ORM\JoinTable(name="answer_record_answers", 
     *      joinColumns={@ORM\JoinColumn(name="answer_record_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="answer_id", referencedColumnName="id")})
     */
    protected $answers;

    /**
     * @ORM\ManyToMany(targetEntity="Scale",cascade={"persist"})
     * @ORM\JoinTable(name="answer_record_scales", 
     *      joinColumns={@ORM\JoinColumn(name="answer_record_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="scale_answer_id", referencedColumnName="id")})
     */
    protected $scales;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable;
     */
    protected $datetime;


    public function __construct($user,$scales,$answers)
    {
    	$this->user = $user;
    	$this->scales = $scales;
    	$this->answers = $answers;
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getUser()
    {
    	return $this->user;
    }

    public function getScales()
    {
    	return $this->scales;
    }

    public function getAnswers()
    {
    	return $this->answers;
    }

    public function getTest()
    {
        return $this->test;
    }

    public function setTest($test)
    {
        $this->test=$test;
    }

}