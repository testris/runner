<?php

namespace TestCase\Action\TestCase\CreateAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;

class ChangesValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();

        $title = new Input('title');
        $title->getFilterChain()
            ->attachByName('StringTrim');
        $title->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 100]);
        $this->inputFilter->add($title);

        $input = new Input('siteId');
        $input->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0, 'inclusive' => true]);
        $this->inputFilter->add($input);

        $input = new Input('caseId');
        $input->getValidatorChain()
            ->attachByName('Digits')
            ->attachByName('GreaterThan', ['min' => 0]);
        $this->inputFilter->add($input);

        $input = new Input('automatedClass');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $input->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 120]);
        $this->inputFilter->add($input);

        $input = new Input('status');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $input->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 3]);
        $this->inputFilter->add($input);

//        $parentId = new Input('sectionId');
//        $parentId->getFilterChain()
//            ->attachByName('StringTrim');
//        $parentId->getValidatorChain()
//            ->attachByName('Digits')
//            ->attachByName('GreaterThan', ['min' => 0, 'inclusive' => true]);
//        $this->inputFilter->add($parentId);

        $input = new Input('preconditions');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);

        $input = new Input('steps');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);

        $input = new Input('result');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);
    }

    public function getValid()
    {
        $valid = parent::getValid();

        if (!isset($valid['automatedClass'])) {
            $valid['automatedClass'] = '';
        }

        return $valid;
    }
}
