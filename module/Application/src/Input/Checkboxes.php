<?php

namespace Application\Input;

use Zend\InputFilter\Input;

class Checkboxes extends Input
{
    public function __construct($name = 'checkboxes', $isRequired = false)
    {
        parent::__construct($name);

        $this->setRequired($isRequired);
        $this->getValidatorChain()
            ->attachByName(
                'Callback',
                ['callback' => function ($values) {
                    foreach ($values as $id => $value) {
                        if (!is_numeric($value)) {
                            return false;
                        }
                    }

                    return true;
                }]);
    }
}