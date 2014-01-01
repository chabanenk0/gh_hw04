<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

use Symfony\Component\EventDispatcher\Event;
use Acme\StoreBundle\Order;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="events")
 */
class OpenEvent extends Event
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
    protected $eventId;

    /**
     * @ORM\Column(type="string")
     */
    protected $info;

    public function __construct($id=0,$info='')
    {
        $this->eventId = $id;
        $this->info = $info;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getInfo()
    {
        return $this->info;
    }
}