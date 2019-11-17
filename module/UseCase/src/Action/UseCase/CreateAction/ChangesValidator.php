<?php

namespace UseCase\Action\UseCase\CreateAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;

class ChangesValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();

        $parentId = new Input('sectionId');
        $parentId->getFilterChain()
            ->attachByName('StringTrim');
        $parentId->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0, 'inclusive' => true]);
        $this->inputFilter->add($parentId);

        $priority = new Input('priority');
        $priority->getFilterChain()
            ->attachByName('StringTrim');
        $priority->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0]);
        $this->inputFilter->add($priority);

        $title = new Input('title');
        $title->getFilterChain()
            ->attachByName('StringTrim');
        $title->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 100]);
        $this->inputFilter->add($title);

        $input = new Input('description');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);
    }
}
