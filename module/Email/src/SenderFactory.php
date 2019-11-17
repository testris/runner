<?php

namespace Email;

use Interop\Container\ContainerInterface;
use Zend\Mail\Transport\FileOptions;
use Zend\Mail\Transport\TransportInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SenderFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $mailTransport = $container->get(TransportInterface::class);

        $options = [];
        if (isset($container->get('config')['email'])) {
            $options = $container->get('config')['email'];
        }

        if (isset($container->get('config')['env']) && $container->get('config')['env'] == 'local') {
            $transportOptions = new FileOptions(array(
                'path' => $options['path'],
                'callback' => function () {
                    return 'Message_' . microtime(true) . '_' . mt_rand() . '.eml';
                },
            ));
            $mailTransport->setOptions($transportOptions);
        }

        $builder = $container->get(Builder::class);

        return new Sender($mailTransport, $builder, $options);
    }
}
