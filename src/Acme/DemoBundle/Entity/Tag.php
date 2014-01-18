<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tags")
 */
class Tag
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[A-Za-z]/")
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="TestAssignment", mappedBy="tags")
     * @ORM\JoinTable(name="tests_tags", 
     *      joinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="test_id", referencedColumnName="id")})
     */
    protected $tests;

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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

    public function setDateTimeUploaded($dateTimeUploaded)
    {
        $this->dateTimeUploaded = $dateTimeUploaded;
    }

    public function getDateTimeUploaded()
    {
        return $this->dateTimeUploaded;
    }

    public function setTestReference($testReference)
    {
        $this->testReference = $testReference;
    }

    public function getTestReference()
    {
        return $this->testReference;
    }

}
