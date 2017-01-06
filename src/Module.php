<?php

namespace Ise\Bootstrap;

use Ise\Bootstrap\View\Helper\Navigation\Navbar;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\View\Helper\Navigation;

class Module implements
    BootstrapListenerInterface,
    ConfigProviderInterface,
    DependencyIndicatorInterface,
    ServiceProviderInterface,
    ViewHelperProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $event)
    {
        // Get application
        $application = $event->getApplication();

        // Attach dispatch listener events
        $renderListener = $application->getServiceManager()->get(Listener\DispatchListener::class);
        $renderListener->attach($application->getEventManager());

        // Add navigation view helper
        $viewManager = $application->getServiceManager()->get('ViewHelperManager');
        $navigation  = $viewManager->get(Navigation::class);
        $navigation->getPluginManager()->setInvokableClass('navbar', Navbar::class, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getViewHelperConfig()
    {
        return include __DIR__ . '/../config/helpers.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/../config/services.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleDependencies()
    {
        return [
            'AssetManager',
        ];
    }
}
