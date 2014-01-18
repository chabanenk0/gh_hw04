<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 12.11.13
 * Time: 22:11
 */

namespace chabanenk0\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use chabanenk0\TestAssignmentBundle\Entity\Test;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity="chabanenk0\GuestbookBundle\Entity\Post", mappedBy="testReference",cascade="persist")
     */
    protected $posts;

    /**
     * @ORM\OneToOne(targetEntity="chabanenk0\TestAssignmentBundle\Entity\Test", cascade="persist")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     */
    protected $test;

    /**
     * @ORM\Column(type="integer")
     */
    protected $visits;


    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable;
     */
    protected $dateTimeUploaded;

    /**
     * @Assert\File(maxSize="6000000")
     * @ORM\Column(type="string", nullable=true)
     */
     protected $image;


    public function __construct()
    {
        $this->tags=new ArrayCollection();
        $this->visits = 0;
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

   public function getDateTimeUploaded()
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

    public function getVisits()
    {
        return $this->visits;
    }

    public function increaseVisits()
    {
        $this->visits=$this->visits+1;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image=$image;
    }

}