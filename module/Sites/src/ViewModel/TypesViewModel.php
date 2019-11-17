<?php

namespace Sites\ViewModel;

use Zend\View\Model\ViewModel;
use Sites\Entity\SiteType;

class TypesViewModel extends ViewModel
{
    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function getVariable($name, $default = null)
    {
        if ($name == 'value') {
            $typeId = parent::getVariable('value');
            return SiteType::getName($typeId);
        }

        return parent::getVariable($name, $default);
    }
}