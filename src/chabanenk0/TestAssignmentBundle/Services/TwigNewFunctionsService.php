<?php

namespace chabanenk0\TestAssignmentBundle\Services;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

class TwigNewFunctionsService extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('dotdotdot', array($this, 'dotdotdotFilter')),
        );
    }

    //source: http://otvety.google.ru/otvety/thread?tid=72f5d2bf6b2dc755
    private function cp1251_to_utf8($s){
          $c209 = chr(209); $c208 = chr(208); $c129 = chr(129);
          for($i=0; $i<strlen($s); $i++)    {
              $c=ord($s[$i]);
              if ($c>=192 and $c<=239) $t.=$c208.chr($c-48);
              elseif ($c>239) $t.=$c209.chr($c-112);
              elseif ($c==184) $t.=$c209.$c209;
              elseif ($c==168)    $t.=$c208.$c129;
              else $t.=$s[$i];
          }
          return $t;
      }

      //source: http://otvety.google.ru/otvety/thread?tid=72f5d2bf6b2dc755
    private function utf8_to_cp1251($s)
       {
           for ($c=0;$c<strlen($s);$c++)
           {
              $i=ord($s[$c]);
              if ($i<=127) $out.=$s[$c];
                  if ($byte2){
                      $new_c2=($c1&3)*64+($i&63);
                      $new_c1=($c1>>2)&5;
                      $new_i=$new_c1*256+$new_c2;
                  if ($new_i==1025){
                      $out_i=168;
                  } else {
                      if ($new_i==1105){
                          $out_i=184;
                      } else {
                          $out_i=$new_i-848;
                      }
                  }
                  $out.=chr($out_i);
                  $byte2=false;
                  }
              if (($i>>5)==6) {
                  $c1=$i;
                  $byte2=true;
              }
           }
           return $out;
       }


    public function dotdotdotFilter($text, $number = 20)
    {
        $decodedText=iconv( mb_detect_encoding($text, mb_detect_order(), true), 'windows-1251', $text);//utf8_decode($text);
        //var_dump(mb_detect_encoding($text, mb_detect_order(), true));
        if (mb_strlen($decodedText)>$number) {
            $newText=mb_substr($decodedText,0,$number);
            $newText=iconv("windows-1251", "UTF-8", $newText);//utf8_decode($text);$decodedText=
            $newText=$newText."...";

            return $newText;
        }
        else {

            return $text;
        }
    }

    public function getName()
    {
        return 'chabanenk0_twig_extension';
    }
}

