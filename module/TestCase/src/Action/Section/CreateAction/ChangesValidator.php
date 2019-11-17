<?php

namespace TestCase\Action\Section\CreateAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class ChangesValidator extends BaseValidator
{
    public function __construct()
    {
        $name = new Input('name');
        $name->getFilterChain()
            ->attachByName('StringTrim');
        $name->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 100]);

        $parentId = new Input('parentId');
        $parentId->getFilterChain()
            ->attachByName('StringTrim');
        $parentId->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0, 'inclusive' => true]);

        $this->inputFilter = new InputFilter();
        $this->inputFilter->add($name);
        $this->inputFilter->add($parentId);
    }
}
