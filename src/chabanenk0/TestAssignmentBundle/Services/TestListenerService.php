<?php

namespace chabanenk0\TestAssignmentBundle\Services;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

class TestListenerService implements EventSubscriberInterface
{
    protected $doctrine;

    protected $EventDispatcher;

    public function __construct($doctrine, $EventDispatcher)
    {
    	//var_dump("constructSDervices");
    	$this->doctrine=$doctrine;
    	$EventDispatcher->addListener("chabtest.opentest",array($this,'onOpenAction'));
    	$this->EventDispatcher = $EventDispatcher;
    }

    
    public function onOpenAction(Event $event)
    {
        $event->getDispatcher()->dispatch('log', $event);
        //var_dump("onOpenAction!!");
        $em = $this->doctrine->getManager();
        $em->persist($event);
        $em->flush();
    }

    public static function getSubscribedEvents()
    {
    	return array('chabtest.opentest'=>'onOpenAction');
    }
    
}