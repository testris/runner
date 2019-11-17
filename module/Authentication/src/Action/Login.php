<?php

namespace Authentication\Action;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractController;
use Zend\View\Model\ModelInterface as ViewModelInterface;
use Zend\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Http\PhpEnvironment\Request;

class Login extends AbstractController
{
    /**
     * @var AuthenticationService
     */
    private $authService;

    /**
     * @var ViewModelInterface
     */
    private $viewModel;

    /**
     * @param AuthenticationService $authService
     * @param ViewModelInterface $viewModel
     */
    public function __construct(
        AuthenticationService $authService,
        ViewModelInterface $viewModel
    )
    {
        $this->authService = $authService;
        $this->viewModel = $viewModel;
    }

    /**
     * @param MvcEvent $e
     * @return mixed|\Zend\Http\Response|ViewModelInterface
     */
    public function onDispatch(MvcEvent $e)
    {

        /** @var Request $request */
        $request = $e->getRequest();
        if ($request->isGet()) {
            $e->setResult($this->viewModel);
            return $this->viewModel;
        }

        /** @var AbstractAdapter $authAdapter */
        $authAdapter = $this->authService->getAdapter();
        $authAdapter->setIdentity($request->getPost('email'));
        $authAdapter->setCredential($request->getPost('password'));

        // Attempt authentication, saving the result:
        $result = $this->authService->authenticate();

        if (!$result->isValid()) {
            // Authentication failed; print the reasons why:
            $this->viewModel->setVariables([
                'result' => [
                    'error' => $result->getMessages()[0]
                ],
            ]);

            $e->setResult($this->viewModel);

            return $this->viewModel;
        }

        return $this->redirect()->toRoute('home');
    }
}
