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
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $viewRenderer = $container->get('ViewRenderer');
        return new $requestedName($viewRenderer);
    }
    
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }
}
