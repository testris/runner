<?php

namespace Application\ViewModel;

use T4webDomainInterface\EntityInterface;
use Zend\View\Model\ViewModel;

class FormNewViewModel extends ViewModel
{
    /**
     * @param string $name
     * @param mixed $value
     * @return ViewModel
     */
    public function setVariable($name, $value)
    {
        if ($name == 'changes' || $name == 'result') {

            $values = $this->getVariable('values', []);

            if (is_array($value)) {
                $values = array_merge($values, $value);
            }
            if ($value instanceof EntityInterface) {
                $values = array_merge($values, $value->extract());
            }

            return parent::setVariable('values', $values);
        }
        if ($name == 'changesErrors') {
            return parent::setVariable('errors', $value);
        }

        return parent::setVariable($name, $value);
    }
}