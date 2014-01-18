<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TestAssignmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('description', 'textarea');
        $builder->add('tags', 'entity',array(
            'class'=>'AcmeDemoBundle:Tag',
            'property'=>'name',
            'expanded'=>false,
            'multiple'=>true,
            'empty_value'=>true,
            ));
        $builder->add('image', 'file', array('required'=>false));
    }

    public function getName()
    {
        return '_user_';
    }
}
