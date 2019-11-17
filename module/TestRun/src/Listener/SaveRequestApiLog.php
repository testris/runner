<?php

namespace TestRun\Listener;

use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\MvcEvent;
use Zend\Router\Http\RouteMatch;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestRun\Entity\ApiLog;

class SaveRequestApiLog
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
        /** @var Request $request */
        $request = $e->getRequest();

        /** @var RouteMatch $routeMatch */
        $routeMatch = $e->getRouteMatch();

        if (! $request instanceof Request) {
            return;
        }

        if (! $routeMatch instanceof RouteMatch) {
            return;
        }

        $acceptedRoutes = [
            'TestRun-result-callback',
            'TestRun-save-output',
            'TestRun-hosts-ready-callback',
        ];

        if (!in_array($routeMatch->getMatchedRouteName(), $acceptedRoutes)) {
            return;
        }

        $runId = $routeMatch->getParam('id');

        if ($request->isPost()) {
            /** @var \Zend\Http\Header\ContentType $contentType */
            $contentType = $request->getHeaders()->get('content-type');
            if ($contentType) {
                if ($contentType->getMediaType() == 'application/json') {
                    $this->apiLogRepository->add(new ApiLog([
                        'uri' => $request->getRequestUri(),
                        'request' => $request->getContent(),
                        'created' => date('Y-m-d H:i:s'),
                        'runId' => $runId,
                    ]));
                }
            }
        }
    }
}