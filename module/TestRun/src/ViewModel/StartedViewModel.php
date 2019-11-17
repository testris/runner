<?php

namespace TestRun\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use Zend\View\Model\ViewModel;

class StartedViewModel extends ViewModel
{

    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function getVariable($name, $default = null)
    {
        if ($name == 'value') {
            $value = parent::getVariable($name, $default);

            return (is_null($value)) ? 'Not started' : $value;
        }

        if ($name == 'userName') {
            /** @var RepositoryInterface $userRepository */
            $userRepository = parent::getVariable('userRepository');

            $user = $userRepository->findById(parent::getVariable('userId'));
            
            if (!$user) {
                return 'unknown';
            }
            
            return $user->getName();
        }

        return parent::getVariable($name, $default);
    }
}