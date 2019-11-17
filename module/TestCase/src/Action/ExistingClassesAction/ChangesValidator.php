<?php

namespace TestCase\Action\ExistingClassesAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class ChangesValidator extends BaseValidator
{
    public function __construct()
    {
        $this->inputFilter = new InputFilter();

        $input = new Input('classes');
        $input->setRequired(true);
        $this->inputFilter->add($input);

        $input = new Input('branch');
        $input->setRequired(true);
        $this->inputFilter->add($input);
    }
}
