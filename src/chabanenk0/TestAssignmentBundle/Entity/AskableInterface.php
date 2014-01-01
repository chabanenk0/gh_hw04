<?php

namespace chabanenk0\TestAssignmentBundle\Entity;

interface AskableInterface
{
    public function askQuestion();
    public function addQuestionToForm($formBuilder);
}
