<?php

namespace chabanenk0\TestAssignmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScaleScoreType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('score')
            ->add('answer')
            ->add('scale')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chabanenk0\TestAssignmentBundle\Entity\ScaleScore'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'chabanenk0_testassignmentbundle_scalescore';
    }
}
