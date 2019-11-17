<?php

namespace Authentication\ViewHelper;

use Zend\Authentication\AuthenticationService;
use Zend\View\Helper\AbstractHelper;

class IsAuthorized extends AbstractHelper
{
    /**
     * @var AuthenticationService
     */
    protected $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke()
    {
        return $this->authService->hasIdentity();
    }
}
