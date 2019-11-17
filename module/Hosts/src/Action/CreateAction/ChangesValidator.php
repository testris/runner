<?php

namespace Hosts\Action\CreateAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class ChangesValidator extends BaseValidator
{
    public function __construct()
    {
        $this->inputFilter = new InputFilter();

        $input = new Input('branch');
        $input->setRequired(true)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);

        $input = new Input('site');
        $input->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);

        $input = new Input('environment');
        $input->setRequired(true)
            ->getValidatorChain()
            ->attachByName('Digits');
        $this->inputFilter->add($input);
    }

}
