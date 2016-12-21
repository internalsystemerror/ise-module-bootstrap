<?php

namespace IseBootstrap;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

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

        // Attach view render listener
        $application->getEventManager()->attachAggregate(
            new View\Listener\RendererListener
        );

        // Add navigation view helper
        $viewManager = $application->getServiceManager()->get('viewhelpermanager');
        $navigation  = $viewManager->get('navigation');
        $navigation->getPluginManager()->setInvokableClass(
            'navbar',
            'IseBootstrap\View\Helper\Navigation\Navbar',
            true
        );
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
     * Get diagnostics for use with ZendDiagnostics module
     *
     * @return array
     */
    public function getDiagnostics()
    {
        return [
            'Twitter Boostrap CDN is available' => [
                'HttpService', 'maxcdn.bootstrapcdn.com'
            ],
            'JQuery CDN is available'           => [
                'HttpService', 'code.jquery.com'
            ],
            'jQuery Timeago CDN is available'   => [
                'HttpService', 'timeago.yarp.com'
            ],
            'Max CDN is available'              => [
                'HttpService', 'oss.maxcdn.com'
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleDependencies()
    {
        if (defined('APPLICATION_ENV') && in_array(APPLICATION_ENV, ['development', 'testing'])) {
            return [
                'AssetManager',
            ];
        }
        return [];
    }
}
