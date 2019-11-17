<?php

namespace TestRun;

use Zend\EventManager\EventManager;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        /** @var EventManager $eventManager */
        $eventManager = $e->getApplication()->getEventManager();
        $serviceManager = $e->getApplication()->getServiceManager();

        $eventManager->attach(
            MvcEvent::EVENT_DISPATCH,
            $serviceManager->get(Listener\SaveRequestApiLog::class),
            1000
        );
        $eventManager->attach(
            MvcEvent::EVENT_RENDER,
            $serviceManager->get(Listener\SaveResponseApiLog::class),
            1000
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
