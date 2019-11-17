<?php

namespace Users\Action\UpdateAction;

use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;

class ChangesValidator extends BaseValidator
{
    private $errors;

    public function __construct()
    {
        parent::__construct();

        $title = new Input('name');
        $title->getFilterChain()
            ->attachByName('StringTrim');
        $title->getValidatorChain()
            ->attachByName('StringLength', ['min' => 0, 'max' => 50]);
        $this->inputFilter->add($title);

        $input = new Input('email');
        $input->getValidatorChain()
            ->attachByName('EmailAddress');
        $this->inputFilter->add($input);

        $input = new Input('notifications');
        $input->getValidatorChain()->attachByName('InArray', [
            'haystack' => [0, 1]
        ]);
        $input->setFallbackValue(false);
        $this->inputFilter->add($input);

        $input = new Input('autoNotifications');
        $input->getValidatorChain()->attachByName('InArray', [
            'haystack' => [0, 1]
        ]);
        $input->setFallbackValue(false);
        $this->inputFilter->add($input);

        $input = new Input('password');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);

        $input = new Input('password2');
        $input->setRequired(false)
            ->getFilterChain()
            ->attachByName('StringTrim');
        $this->inputFilter->add($input);
    }

    public function isValid($data)
    {
        $isValid = parent::isValid($data);

        if (!empty($data['password']) && $data['password'] != $data['password2']) {
            $this->errors['password'][] = 'Password did not match';
            $isValid = false;
        }

        return $isValid;
    }

    public function getErrors()
    {
        return parent::getErrors() + $this->errors;
    }
}
