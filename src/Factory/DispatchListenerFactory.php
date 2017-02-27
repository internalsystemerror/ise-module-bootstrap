<?php

namespace Ise\Bootstrap\Factory;

use Interop\Container\ContainerInterface;
use Ise\Bootstrap\Listener\DispatchListener;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class DispatchListenerFactory implements FactoryInterface
{
    /**
     * Create the DispatchListener instance
     *
     * @param ContainerInterface $container
     * @param type $requestedName
     * @return DispatchListener
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName($container->get('ViewRenderer'));
    }
    
    /**
     * {@inheritDoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }
}
