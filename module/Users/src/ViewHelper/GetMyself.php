<?php

namespace Users\ViewHelper;

use Zend\Authentication\AuthenticationService;
use Zend\View\Helper\AbstractHelper;
use T4webDomainInterface\Infrastructure\RepositoryInterface;

class GetMyself extends AbstractHelper
{
    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @var RepositoryInterface
     */
    protected $userRepository;

    public function __construct(AuthenticationService $authService, RepositoryInterface $userRepository)
    {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        return $this->get();
    }

    public function get()
    {
        if (!$this->authService->hasIdentity()) {
            return;
        }

        return $this->userRepository->find([
            'email_equalTo' => $this->authService->getIdentity()
        ]);
    }
}
