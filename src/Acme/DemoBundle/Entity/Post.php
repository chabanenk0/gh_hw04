<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
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
     * @ORM\Column(type="string")
     * @Assert\Email
     * @Assert\NotBlank
     */
    protected $email;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    protected $message;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable;
     */
    protected $dateTimeUploaded;

    /**
     * @ORM\ManyToOne(targetEntity="TestAssignment", inversedBy="posts")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     */
    protected $testReference;

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
