<?php

namespace TestRun\Action\CreateAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Application\Input\Checkboxes;

class ChangesValidator extends BaseValidator
{
    public function __construct()
    {
        $this->inputFilter = new InputFilter();

        $title = new Input('title');
        $title->getFilterChain()
            ->attachByName('StringTrim');
        $title->getValidatorChain()
            ->attachByName('StringLength', ['min' => 1, 'max' => 100]);
        $this->inputFilter->add($title);

        $input = new Input('environment');
        $input->setRequired(true)
            ->getValidatorChain()
            ->attachByName('Digits');
        $this->inputFilter->add($input);

        $input = new Input('branch');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);

        $this->inputFilter->add(new Checkboxes('caseIds', true));
    }

}
