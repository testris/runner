<?php

namespace Authentication\Action;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractController;
use Zend\View\Model\ModelInterface as ViewModelInterface;
use Zend\Authentication\AuthenticationService;

class Logout extends AbstractController
{
    /**
     * @var AuthenticationService
     */
    private $authService;

    /**
     * @param AuthenticationService $authService
     */
    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param MvcEvent $e
     * @return mixed|\Zend\Http\Response|ViewModelInterface
     */
    public function onDispatch(MvcEvent $e)
    {
        $this->authService->clearIdentity();

        return $this->redirect()->toRoute('auth-login');
    }
}