<?php

namespace TestRun\Action\DeleteReferenceAction;

use T4web\Crud\Validator\BaseFilter;
use Zend\InputFilter\Input;
use Zend\Validator\File\Exists;

class CriteriaValidator extends BaseFilter
{
    private $errors;

    public function __construct()
    {
        parent::__construct();

        $filename = new Input('filename');

        $filename->setRequired(true);
        $filename->getFilterChain()->attachByName('StringTrim');
        $filename->getValidatorChain()->attachByName('StringLength', ['min' => 1, 'max' => 100]);

        $this->inputFilter->add($filename);
    }

    public function isValid($data)
    {
        $isValid = parent::isValid($data);

        $fileName = $data['filename'];
        $referencesDir = dirname($_SERVER['DOCUMENT_ROOT']) . '/data/VisualCeption';
        $referenceFilePath = "$referencesDir/$fileName";

        if (!file_exists($referenceFilePath)) {
            $this->errors['filename'][] = 'Source does not exists';
            $isValid = false;
        }

        return $isValid;
    }

    public function getErrors()
    {
        return parent::getErrors() + $this->errors;
    }
}
