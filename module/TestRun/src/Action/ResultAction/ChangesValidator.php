<?php

namespace TestRun\Action\ResultAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class ChangesValidator extends BaseValidator
{
    public function __construct()
    {
        $this->inputFilter = new InputFilter();

        $input = new Input('automatedClass');
        $input->setRequired(true)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $input->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 120]);
        $this->inputFilter->add($input);

        $input = new Input('result');
        $input->getFilterChain()
            ->attachByName('StringTrim');
        $input->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 100]);
        $this->inputFilter->add($input);

        $input = new Input('resultMessage');
        $input->setRequired(false);
        $input->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);

        $input = new Input('steps');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);

        $input = new Input('execTime');
        $input->setRequired(true)
            ->getValidatorChain()
            ->attachByName('GreaterThan', ['min' => 0, 'inclusive' => true]);
        $this->inputFilter->add($input);
    }
}
