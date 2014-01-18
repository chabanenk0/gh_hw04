<?php

namespace chabanenk0\TestAssignmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('testName', 'text');
        $builder->add('testDescription', 'text');
        $builder->add('scales', 'entity');
        $builder->add('questions', 'entity');
    }

    public function getName()
    {
        return '_user_';
    }
}
