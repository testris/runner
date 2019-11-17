<?php

namespace Sites\Action\CreateAction;

use Sites\Entity\SiteType;
use T4web\Crud\Validator\BaseValidator;
use Zend\InputFilter\Input;

class ChangesValidator extends BaseValidator
{
    private $errors;

    public function __construct()
    {
        parent::__construct();

        $domain = new Input('domain');
        $domain->getFilterChain()
            ->attachByName('StringTrim');
        $domain->getValidatorChain()
            ->attachByName('StringLength', ['min' => 3, 'max' => 100]);
        $this->inputFilter->add($domain);

        $type = new Input('type');
        $type->setRequired(true);
        $type->getValidatorChain()->attachByName(
            'InArray',
            [
                'haystack' => SiteType::getIds(),
            ]
        );
        $this->inputFilter->add($type);
    }
}
