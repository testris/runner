<?php

namespace Email;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BuilderFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $emailView = [];
        $config = $container->get('config');
        if (isset($config['email']['email-view'])) {
            $emailView = $config['email']['email-view'];
        }

        /** @var \Zend\View\Renderer\PhpRenderer $renderer */
        $renderer = $container->get('ViewPhpRenderer');

        return new Builder(
            $container,
            $emailView,
            $renderer
        );
    }
}
