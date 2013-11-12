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
    protected $formFactory;
    protected $twig;

    public function __construct()
    {
    // Overwrite this with your own secret
        define('CSRF_SECRET', 'c2ioeEU1n48QF2WsHGWd2HmiuUUT6dxr');
        define('DEFAULT_FORM_THEME', 'form_div_layout.html.twig');

        define('VENDOR_DIR', realpath(__DIR__ . '/../../vendor'));
        define('VENDOR_FORM_DIR', VENDOR_DIR . '/symfony/form/Symfony/Component/Form');
        define('VENDOR_VALIDATOR_DIR', VENDOR_DIR . '/symfony/validator/Symfony/Component/Validator');
        define('VENDOR_TWIG_BRIDGE_DIR', VENDOR_DIR . '/symfony/twig-bridge/Symfony/Bridge/Twig');
        define('VIEWS_DIR', realpath(__DIR__ . '/../View'));

        // Set up the CSRF provider
        $csrfProvider = new DefaultCsrfProvider(CSRF_SECRET);
        // Set up the Validator component
        $validator = Validation::createValidator();

        // Set up the Translation component
        $translator = new Translator('en');
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource('xlf', VENDOR_FORM_DIR . '/Resources/translations/validators.en.xlf', 'en', 'validators');
        $translator->addResource('xlf', VENDOR_VALIDATOR_DIR . '/Resources/translations/validators.en.xlf', 'en', 'validators');

        // Set up Twig
        $twig = new \Twig_Environment(new \Twig_Loader_Filesystem(array(
            VIEWS_DIR,
            VENDOR_TWIG_BRIDGE_DIR . '/Resources/views/Form',
        )));
        $formEngine = new TwigRendererEngine(array(DEFAULT_FORM_THEME));
        $formEngine->setEnvironment($twig);
        $twig->addExtension(new TranslationExtension($translator));
        $twig->addExtension(new FormExtension(new TwigRenderer($formEngine, $csrfProvider)));

        // Set up the Form component
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new CsrfExtension($csrfProvider))
                ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();
        $this->formFactory=$formFactory;
        $this->twig=$twig;
    }
    public function clearQuestions()
    {
        $this->questions=array();
    }

    public function addQuestion(AbstractTestQuestion $newQuestion)
    {
        array_push($this->questions, $newQuestion);
    }

    public function askQuestions()
    {
        //$formFactory = Forms::createFormFactory();
        //$loader = new Twig_Loader_Filesystem('view/');
        //$twig= new Twig_Environment($loader, array('cache'=>'cache/'));
        //$twig= new Twig_Environment();
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
        $form=$formBuilder->getForm();
        $questionsText = "<form method=POST action='index.php'>\n<input type=hidden name=mytest value=mytest>\n";

        foreach ($this->questions as $question) {
            $questionsText=$questionsText.$question->askQuestion();
        }
        //$questionsText = $questionsText."<input type=submit value='ok'></form>";
        $questionsText=$this->twig->render("new.html.twig",array('form'=>$form->createView()));

        return $questionsText;
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