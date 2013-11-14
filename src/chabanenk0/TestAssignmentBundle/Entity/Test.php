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


class Test 
{
    protected $questions = array(); // array of AbstractTestQuestion's

    protected $scales = array();

    public function clearQuestions()
    {
        $this->questions=array();
    }

    public function addQuestion(AbstractTestQuestion $newQuestion)
    {
        array_push($this->questions, $newQuestion);
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
            array_push($this->scales, $newScale);
        }
    }
    public function getScales()
    {
        return $this->scales;
    }

    public function calculateScales($request)
    {
        foreach ($this->questions as $currentQuestion) {
            $currentQuestion->calculateScore($request);
        }
    }

}

?>