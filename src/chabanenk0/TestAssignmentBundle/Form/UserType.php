<?php

namespace chabanenk0\TestAssignmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('nick', 'text');
        $builder->add('email', 'email');
        $builder->add('email', 'email');
        $builder->add('passwd', 'password');
    }

    public function getName()
    {
        return '_user_';
    }
}
