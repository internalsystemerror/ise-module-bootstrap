<?php

namespace IseBootstrap\View\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\View\Renderer\PhpRenderer;

class RendererListener implements ListenerAggregateInterface
{

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $eventManager)
    {
        $this->listeners[] = $eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'setupLayout']);
    }

    /**
     * {@inheritDoc}
     */
    public function detach(EventManagerInterface $eventManager)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($eventManager->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Load view parameters
     *
     * @param EventInterface $event
     */
    public function setupLayout(EventInterface $event)
    {
        $match          = $event->getRouteMatch();
        $controller     = $event->getTarget();
        $serviceManager = $event->getApplication()->getServiceManager();
        if (!$match instanceof RouteMatch || $controller->getEvent()->getResult()->terminate() || !$serviceManager->has('ViewRenderer')) {
            return;
        }

        // Configure renderer
        $viewRenderer = $serviceManager->get('ViewRenderer');
        if (!$viewRenderer instanceof PhpRenderer) {
            return;
        }
        $this->configureViewRenderer($viewRenderer);
    }

    /**
     * Configure view renderer
     *
     * @param PhpRenderer $viewRenderer
     */
    protected function configureViewRenderer(PhpRenderer $viewRenderer)
    {
        // Set meta data
        $viewRenderer->headMeta()->setCharset('UTF-8')
            ->appendName('viewport', 'width=device-width, initial-scale=1.0')
            ->appendHttpEquiv('X-UA-Compatible', 'IE=edge');
        $viewRenderer->headTitle()->setSeparator(' :: ')->setAutoEscape(false);

        // Add stylesheets
        $basePath = $viewRenderer->basePath();
        $viewRenderer->headLink([
            'rel'  => 'shortcut icon',
            'type' => 'image/vnd.microsoft.icon',
            'href' => $basePath . '/favicon.ico',
        ])->appendStylesheet($basePath . '/css/master.css');

        // Add scripts
        $viewRenderer->headScript()->setAllowArbitraryAttributes(true)->appendFile(
            $basePath . '/js/fix/ltIE9.js',
            'text/javascript',
            ['conditional' => 'lt IE 9']
        );
        $viewRenderer->inlineScript()->setAllowArbitraryAttributes(true)->appendFile($basePath . '/js/master.js');
    }
}
