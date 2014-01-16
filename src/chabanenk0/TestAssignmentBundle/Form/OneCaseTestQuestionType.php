<?php

namespace chabanenk0\TestAssignmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OneCaseTestQuestionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('numberOfAnswers')
            ->add('question')
            ->add('testId')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chabanenk0\TestAssignmentBundle\Entity\OneCaseTestQuestion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'chabanenk0_testassignmentbundle_onecasetestquestion';
    }
}
