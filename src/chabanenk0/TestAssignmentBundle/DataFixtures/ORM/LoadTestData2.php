<?php

namespace chabanenk0\TestAssignmentBundle\DataFixtures\ORM;;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use chabanenk0\TestAssignmentBundle\Entity\Test;
use chabanenk0\TestAssignmentBundle\Entity\Scale;
use chabanenk0\TestAssignmentBundle\Entity\ScaleScore;
use chabanenk0\TestAssignmentBundle\Entity\OneCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\MultiCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Entity\Answer;
use Doctrine\Common\Collections\ArrayCollection;

class LoadTestData2 implements FixtureInterface
    {
        /**
* {@inheritDoc}
*/
        public function load(ObjectManager $manager)
        {
            $test=new Test();
            $test->setTestName("Тест темперамента Айзенка");
            $test->setTestDescription("Тест темперамента Айзенка (холерик, сангвиник, флегматик, меланхолик). Используются шкалы: экстраверсии, эмоциональной устойчивости, лжи, ");
            $extraversiyaScale=new Scale();
            $extraversiyaScale->setName('экстраверсии');
            $test->addScale($extraversiyaScale);
            $ustoychivostScale=new Scale();
            $ustoychivostScale->setName('устойчивости');
            $test->addScale($ustoychivostScale);
            $lieScale=new Scale();
            $lieScale->setName('лжи');
            $test->addScale($lieScale);
            $questions = $this->getAnswersArray();
			
			foreach ($questions as $question) {
			    $a=new OneCaseTestQuestion();
				$a->setQuestion($question['text']);
				$yesAnswer=new Answer("Да", new ScaleScore($extraversiyaScale,$question['extraversiyaScaleYes']));
				//$yesAnswer->addScore($extraversiyaScale,$question['extraversiyaScaleYes']);
				$yesAnswer->addScore($ustoychivostScale,$question['ustoychivostScaleYes']);
				$yesAnswer->addScore($lieScale,$question['lieScaleYes']);
				$a->addAnswer($yesAnswer);
				$noAnswer=new Answer("Нет",new ScaleScore($extraversiyaScale,$question['extraversiyaScaleNo']));
				//$noAnswer->addScore($extraversiyaScale,$question['extraversiyaScaleNo']);
				$noAnswer->addScore($ustoychivostScale,$question['ustoychivostScaleNo']);
				$noAnswer->addScore($lieScale,$question['lieScaleNo']);
				$a->addAnswer($noAnswer);				
				$test->addQuestion($a);
			}

            $manager->persist($test);
            $manager->flush();
        }
		public function getAnswersArray()
		{
		    $q=array(
			    'Часто ли Вы испытываете тягу к новым впечатлениям, чтобы испытать сильные ощущения?',
				'Часто ли Вы чувствуете, что нуждаетесь в друзьях, которые могут Вас понять, ободрить, выразить сочувствие?',
				'Считаете ли Вы себя беспечным человеком?',
				'Правда ли, что Вам очень трудно отвечать "нет"?',
				'Обдумываете ли Вы свои дела не спеша и предпочитаете ли подождать, прежде чем действовать?',
				'Всегда ли Вы сдерживаете свои обещания, даже если Вам это не выгодно?',
				'Часто ли у Вас бывают спады и подъемы настроения?',
				'Быстро ли Вы обычно действуете и говорите, и не растрачиваете ли много времени на обдумывание?',
				'Возникало ли у Вас когда-нибудь чувство, что Вы несчастны, хотя никакой серьезной причины для этого не было?',
				'Верно ли, что на спор Вы способны решиться на все?',
				'Смущаете ли Вы, когда хотите познакомиться с человеком противоположного пола, который Вам симпатичен?',
				'Бывает ли, что, разозлившись, Вы выходите из себя?',
				'Часто ли Вы действуете под влиянием минутного настроения?',
				'Часто ли Вас беспокоят мысли о том, что Вам не следовало бы чего-нибудь делать или говорить?',
				'Предпочитаете ли Вы чтение книг встречам с людьми?',
				'Вас легко обидеть?',
				'Любите ли Вы часто бывать в компании?',
				'Бывают ли у Вас иногда такие мысли, которые Вы хотели бы скрыть от других людей?',
				'Верно, что иногда Вы настолько полны энергии, что все горит в руках, а иногда чувствуете сильную вялость?',
				'Предпочитаете ли Вы иметь друзей поменьше, но особенно близких Вам?',
				'Часто ли Вы мечтаете?',
				'Когда на Вас кричат, Вы отвечаете тем же?',
				'Часто ли Вас тревожит чувство вины?',
				'Все ли ваши привычки хороши и желательны?',
				'Способны ли Вы дать волю собственным чувствам и вовсю повеселиться в шумной компании?',
				'Считаете ли Вы себя человеком возбудимым и чувствительным?',
				'Считают ли Вас человеком живым и веселым?',
				'После того, как дело сделано, часто ли Вы возвращаетесь к нему мысленно и думает, что могли бы сделать лучше?',
				'Вы обычно молчаливый и сдержанный, когда находитесь среди людей?',
				'Вы иногда сплетничаете?',
				'Бывает ли, что Вам не спиться оттого, что разные мысли лезут в голову?',
				'Верно ли, что Вам приятнее и легче прочесть о том, что Вас интересует в книге, хотя можно быстрее и проще узнать об этом у друзей?',
				'Бывает ли у Вас сильное сердцебиение?',
				'Нравиться ли Вам работа, требующая постоянного внимания?',
				'Бывает ли, что Вас "бросает в дрожь"?',
				'Верно ли, что Вы всегда говорите о знакомых Вам людях только хорошее, даже тогда, когда уверены, что они об этом не узнают?',
				'Верно ли, что Вам не приятно бывать в компании, где постоянно подшучивают друг над другом?',    
				'Вы раздражительны?',
				'Нравиться ли Вам работа, которая требует быстроты действий?',
				'Верно ли, что Вас не редко не дают покоя мысли о разных неприятностях и "ужасах", которые могли бы произойти, хотя все кончилось благополучно?',
				'Вы ходите медленно и неторопливо?',
				'Вы когда-нибудь опаздывали на свидание, работу или учебу?',
				'Часто ли Вам снятся кошмары?',
				'Верно ли, что Вы такой любитель поговорить, что никогда не упустите удобного случая побеседовать с незнакомым человеком?',
				'Беспокоят ли Вас какие-нибудь боли?',
				'Огорчились бы Вы, если бы долго не могли видеться со своими друзьями?',
				'Можете ли Вы назвать себя нервным человеком?',
				'Есть ли среди Ваших знакомых такие, которые Вам явно не нравятся?',
				'Можете Вы сказать, что Вы уверенный в себе человек?',
				'Легко ли Вас задевает критика Ваших недостатков или Вашей работы?',
				'Трудно ли получить настоящее удовольствие от вечеринки?',
				'Беспокоит ли Вас чувство, что Вы чем-то хуже других?',
				'Сумели бы Вы внести оживление в скучную компанию?',
				'Бывает ли, что Вы говорите о вещах, в которых совсем не разбираетесь?',
				'Беспокоитесь ли Вы о своем здоровье?',
				'Любите ли Вы подшутить над другими?',
				'Страдаетe ли Вы от бессонницы? ',
			);
			$qscales=array();
			for ($i=0;$i<count($q);$i=$i+1) {
				$qscales[$i]=array('text'=>$q[$i],'extraversiyaScaleYes'=>0,'extraversiyaScaleNo'=>0,'ustoychivostScaleYes'=>0,'ustoychivostScaleNo'=>0,'lieScaleYes'=>0,'lieScaleNo'=>0);
			}
			
			$qscales[6-1]['lieScaleYes']=1;
			$qscales[24-1]['lieScaleYes']=1;
			$qscales[36-1]['lieScaleYes']=1;
			$qscales[12-1]['lieScaleNo']=1;
			$qscales[18-1]['lieScaleNo']=1;
			$qscales[30-1]['lieScaleNo']=1;
			$qscales[42-1]['lieScaleNo']=1;
			$qscales[48-1]['lieScaleNo']=1;
			$qscales[54-1]['lieScaleNo']=1;
			
			//da-  1, 3, 8, 10,, 13, 17, 22, 25, 27, 37, 39, 44, 46, 49, 53, 56.
			$qscales[1-1]['extraversiyaScaleYes']=1;
			$qscales[3-1]['extraversiyaScaleYes']=1;
			$qscales[8-1]['extraversiyaScaleYes']=1;
			$qscales[10-1]['extraversiyaScaleYes']=1;
			$qscales[13-1]['extraversiyaScaleYes']=1;
			$qscales[17-1]['extraversiyaScaleYes']=1;
			$qscales[22-1]['extraversiyaScaleYes']=1;
			$qscales[25-1]['extraversiyaScaleYes']=1;
			$qscales[27-1]['extraversiyaScaleYes']=1;
			$qscales[37-1]['extraversiyaScaleYes']=1;
			$qscales[39-1]['extraversiyaScaleYes']=1;
			$qscales[44-1]['extraversiyaScaleYes']=1;
			$qscales[46-1]['extraversiyaScaleYes']=1;
			$qscales[49-1]['extraversiyaScaleYes']=1;
			$qscales[53-1]['extraversiyaScaleYes']=1;
			$qscales[56-1]['extraversiyaScaleYes']=1;
			//net- 5, 15, 20, 29, 32, 34, 41, 51.
			$qscales[5-1]['extraversiyaScaleNo']=1;
			$qscales[15-1]['extraversiyaScaleNo']=1;
			$qscales[20-1]['extraversiyaScaleNo']=1;
			$qscales[29-1]['extraversiyaScaleNo']=1;
			$qscales[32-1]['extraversiyaScaleNo']=1;
			$qscales[34-1]['extraversiyaScaleNo']=1;
			$qscales[41-1]['extraversiyaScaleNo']=1;
			$qscales[51-1]['extraversiyaScaleNo']=1;
			
			//ustoychivost da 2, 4, 7, 9, 11, 14, 16, 19, 21, 23, 
			//26, 28, 31, 33, 35, 38, 40, 43, 45, 47, 50, 52, 55, 57.
			$qscales[2-1]['ustoychivostScaleYes']=1;
			$qscales[4-1]['ustoychivostScaleYes']=1;
			$qscales[7-1]['ustoychivostScaleYes']=1;
			$qscales[9-1]['ustoychivostScaleYes']=1;
			$qscales[11-1]['ustoychivostScaleYes']=1;
			$qscales[14-1]['ustoychivostScaleYes']=1;
			$qscales[16-1]['ustoychivostScaleYes']=1;
			$qscales[19-1]['ustoychivostScaleYes']=1;
			$qscales[21-1]['ustoychivostScaleYes']=1;
			$qscales[23-1]['ustoychivostScaleYes']=1;
			$qscales[26-1]['ustoychivostScaleYes']=1;
			$qscales[28-1]['ustoychivostScaleYes']=1;
			$qscales[31-1]['ustoychivostScaleYes']=1;
			$qscales[33-1]['ustoychivostScaleYes']=1;
			$qscales[35-1]['ustoychivostScaleYes']=1;
			$qscales[38-1]['ustoychivostScaleYes']=1;
			$qscales[40-1]['ustoychivostScaleYes']=1;
			$qscales[43-1]['ustoychivostScaleYes']=1;
			$qscales[45-1]['ustoychivostScaleYes']=1;
			$qscales[47-1]['ustoychivostScaleYes']=1;
			$qscales[50-1]['ustoychivostScaleYes']=1;
			$qscales[52-1]['ustoychivostScaleYes']=1;
			$qscales[55-1]['ustoychivostScaleYes']=1;
			$qscales[57-1]['ustoychivostScaleYes']=1;
			
			return $qscales;
		}
    }

?>