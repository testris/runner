<?php

namespace TestRun\Listener;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestRun\Entity\ApiLog;

class SaveResponseApiLog
{
    /**
     * @var RepositoryInterface
     */
    private $apiLogRepository;

    public function __construct(RepositoryInterface $apiLogRepository)
    {
        $this->apiLogRepository = $apiLogRepository;
    }

    public function __invoke(MvcEvent $e)
    {
        /** @var JsonModel $viewModel */
        $viewModel = $e->getViewModel();

        if (! $viewModel instanceof JsonModel) {
            return;
        }

        if (empty(ApiLog::getCurrentApiLogEntry())) {
            return;
        }

        /** @var ApiLog $apiLog */
        $apiLog = $this->apiLogRepository->findById(ApiLog::getCurrentApiLogEntry());

        $apiLog->updateResponse($viewModel->serialize());

        $this->apiLogRepository->add($apiLog);
    }
}