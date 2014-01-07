<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 12.11.13
 * Time: 22:11
 */

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use chabanenk0\TestAssignmentBundle\Entity\Test;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="test_assignment")
 */
class TestAssignment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="tests", cascade="persist")
     * @ORM\JoinTable(name="tests_tags", 
     *      joinColumns={@ORM\JoinColumn(name="test_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")})
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="testReference")
     */
    protected $posts;

    /**
     * @ORM\OneToOne(targetEntity="chabanenk0\TestAssignmentBundle\Entity\Test")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     */
    protected $test;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable;
     */
    protected $dateTimeUploaded;

    public function __construct()
    {
        $this->tags=new ArrayCollection();
    }




    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        //$this->test->setDescription($description);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
        //return $this->test->getDescription();
    }

    /**
     * @return mixed
     */
    public function getTestDescription()
    {
        return $this->description;
        //return $this->test->getDescription();
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

   /**
     * @return mixed
     */
    public function getTestId()
    {
        return $this->test->getId();
    }


    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        //$this->test->setName($name);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
        //return $this->test->getName();
    }

    public function getTestName() 
    {
        return $this->name;
        //return $this->test->getName();
    }


   public function setTest(Test $test)
    {
        $this->test = $test;
    }

    public function getTest()
    {
        return $this->test;
    }

   public function getDateTime()
    {
        return $this->dateTimeUploaded;
    }

    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);
    }

    public function getTags()
    {
        return $this->tags;
    }

}