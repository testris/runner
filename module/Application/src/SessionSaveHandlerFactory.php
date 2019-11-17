<?php

namespace Application;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SaveHandler\Cache;
use Zend\Cache\StorageFactory;

class SessionSaveHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        $cache = StorageFactory::factory([
            'adapter' => [
                'name' => 'memcached',
                'options' => [
                    'servers' => [ $config['memcached'], ],
                ],
            ],
        ]);

        return new Cache($cache);
    }
}