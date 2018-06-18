<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap;

use Ise\Bootstrap\View\Helper\Navigation\Navbar;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\View\Helper\Navigation;

class Module implements
    BootstrapListenerInterface,
    ConfigProviderInterface,
    DependencyIndicatorInterface
{

    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $event): void
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
    public function getConfig(): array
    {
        return require __DIR__ . '/../config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleDependencies(): array
    {
        return [
            'AssetManager',
        ];
    }
}
