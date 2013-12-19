<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity
 * @ORM\Table(name="test_results")
 */
class TestResult
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     **/
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Test")
     * @ORM\JoinColumn(name="test", referencedColumnName="id")
     **/
    protected $test;

    /**
     * @ORM\Column(type="integer")
     * @Gedmo\Timestampable;
     */
    protected $datetime;

    public function setUser($user)
    {
        $this->user=$user;
    }



}