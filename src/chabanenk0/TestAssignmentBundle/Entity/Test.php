<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

use chabanenk0\TestAssignmentBundle\Entity\OneCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\MultiCaseTestQuestion;

use Symfony\Component\Validator\Validation;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\DefaultCsrfProvider;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Form;


/**
 * @ORM\Entity
 * @ORM\Table(name="tests")
 */
class Test
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AbstractTestQuestion", mappedBy="testId",cascade={"all"}, fetch="EAGER")
     */
    protected $questions;

    /**
     * @ORM\OneToMany(targetEntity="Scale", mappedBy="testId",cascade={"persist"})
     */
    protected $scales;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $testName;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $testDescription;


    /**
     * @param mixed $testDescription
     */
    public function setTestDescription($testDescription)
    {
        $this->testDescription = $testDescription;
    }

    /**
     * @return mixed
     */
    public function getTestDescription()
    {
        return $this->testDescription;
    }

    /**
     * @param mixed $testName
     */
    public function setTestName($testName)
    {
        $this->testName = $testName;
    }

    /**
     * @return mixed
     */
    public function getTestName()
    {
        return $this->testName;
    }

    public function __construct()
    {
        $this->questions=new ArrayCollection();
        $this->scales=new ArrayCollection();
    }

    public function clearQuestions()
    {
        $this->questions=array();
    }

    public function addQuestion(AbstractTestQuestion $newQuestion)
    {
        $newQuestion->setTestId($this);
        $this->questions->add($newQuestion);
    }

    public function askQuestions($formBuilder)
    {
        //$formFactory = Forms::createFormFactory();
        //$loader = new Twig_Loader_Filesystem('view/');
        //$twig= new Twig_Environment($loader, array('cache'=>'cache/'));
        //$twig= new Twig_Environment();
        /*
        $formBuilder = $this->formFactory->createBuilder();
        $formBuilder->add("mytest","hidden", array(
            "value"=>"mytest",
            "constraints"=>array(
                new NotBlank(),
                new MinLength(4),
            )
        ));
        //$formBuilder->add("q1","text", array("value"=>"mytext1"));
        //$formBuilder->add("q2","text", array("value"=>"mytext2"));
        $form=$formBuilder->getForm();*/
        $questionsText = "<form method=POST action='index.php'>\n<input type=hidden name=mytest value=mytest>\n";

        foreach ($this->questions as $question) {
            $questionsText=$questionsText.$question->askQuestion();
            $formBuilder=$question->addQuestionToForm($formBuilder);
        }
        return $formBuilder;
    }

    public function addScale($newScale)
    {
        if ($newScale instanceof Scale) {
            $newScale->setTestId($this);
            $this->scales->add($newScale);
        }
    }
    public function getScales()
    {
        return $this->scales;
    }

    public function calculateScales($request)
    {
        $selectedAnswers =  array();
        foreach ($this->questions as $currentQuestion) {
            $currentAnswers = $currentQuestion->calculateScore($request);
            $selectedAnswers = array_merge($selectedAnswers,$currentAnswers);
        }

        return $selectedAnswers;
    }

    public function calculateScaleArray(Form $request)
    {
        $selectedAnswers = $this->calculateScales($request);
        $scales = $this->getScales();
        $scaleScoresArray=array();
        foreach ($scales as $scale) {
            $scaleScoresArray[]=$scale->getScore();
        }
        return array(
            'scales'=>$scales,
            'answers'=>new ArrayCollection($selectedAnswers),
        );
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
     * Remove questions
     *
     * @param \chabanenk0\TestAssignmentBundle\Entity\AbstractTestQuestion $questions
     */
    public function removeQuestion(\chabanenk0\TestAssignmentBundle\Entity\AbstractTestQuestion $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Remove scales
     *
     * @param \chabanenk0\TestAssignmentBundle\Entity\Scale $scales
     */
    public function removeScale(\chabanenk0\TestAssignmentBundle\Entity\Scale $scales)
    {
        $this->scales->removeElement($scales);
    }

}