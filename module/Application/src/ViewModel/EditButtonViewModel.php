<?php

namespace Application\ViewModel;

use Zend\View\Model\ViewModel;

class EditButtonViewModel extends ViewModel
{
    public function getVariable($name, $default = null)
    {
        if ($name == 'routeParams') {
            $id = parent::getVariable('id');
            return ['id' => $id];
        }

        if ($name == 'routeOptions') {
            $routeOptions = parent::getVariable('routeOptions');

            if (isset($routeOptions['query'])) {
                foreach ($routeOptions['query'] as $key => $value) {
                    $routeOptions['query'][$key] = parent::getVariable($value);
                }
            }

            return $routeOptions;
        }

        return parent::getVariable($name, $default);
    }
}