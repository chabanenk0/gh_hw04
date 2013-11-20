<?php
/**
 * This class connects scale with some score for right or wrong answer
 * The array of objects of this class are used in the Answer objects
 * Created by PhpStorm.
 * User: dmitry
 * Date: 29.10.13
 * Time: 22:51
 */

namespace chabanenk0\TestAssignmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="scalescores")
 */
class ScaleScore
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Scale", inversedBy="scale")
     * @ORM\JoinColumn(name="scale", referencedColumnName="id")
     **/
    protected $scale;

    /**
     * @ORM\Column(type="float")
     */
    protected $score;

    public function __construct($scale, $score)
    {
        $this->scale=$scale;
        $this->score=$score;
    }

    /**
     * @param mixed $scale
     */
    public function setScale($scale)
    {
        if ($scale instanceof Scale )
            $this->scale = $scale;
    }

    /**
     * @return mixed
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    public function calculateScore()
    {
        $this->scale->increaseScore($this->score);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}