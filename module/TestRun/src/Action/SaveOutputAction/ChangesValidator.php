<?php

namespace TestRun\Action\SaveOutputAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class ChangesValidator extends BaseValidator
{
    public function __construct()
    {
        $this->inputFilter = new InputFilter();

        $input = new Input('output');
        $input->setRequired(true);
        $input->getValidatorChain()->attach(
            new NotEmpty(NotEmpty::NULL)
        );
        $this->inputFilter->add($input);

        $input = new Input('ip');
        $input->setRequired(true);
        $input->getValidatorChain()->attach(
            new NotEmpty(NotEmpty::NULL)
        );
        $this->inputFilter->add($input);
    }
}
