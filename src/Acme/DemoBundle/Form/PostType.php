<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('name', 'text');
        $builder->add('email', 'email');
        $builder->add('ok', 'submit');
        $builder->add('message', 'textarea');
    }

    public function getName()
    {
        return 'post';
    }
}
