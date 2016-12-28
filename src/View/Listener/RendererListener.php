<?php

namespace Ise\Bootstrap\View\Listener;

use Zend\EventManager\SharedEventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Router\Http\RouteMatch;
use Zend\View\ViewEvent;
use Zend\View\Renderer\PhpRenderer;

class RendererListener
{

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * {@inheritDoc}
     */
    public function attach(SharedEventManagerInterface $events, $priority = 1000)
    {
        $this->listeners[] = $events->attach(\Zend\Mvc\Application::class, MvcEvent::EVENT_DISPATCH, [$this, 'setupLayout'], $priority);
    }

    /**
     * {@inheritDoc}
     */
    public function detach(SharedEventManagerInterface $eventManager)
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
     * @param MvcEvent $event
     */
    public function setupLayout(MvcEvent $event)
    {
        $match          = $event->getRouteMatch();
        $serviceManager = $event->getApplication()->getServiceManager();
        if (!$match instanceof RouteMatch || !$serviceManager->has('ViewRenderer')) {
            return;
        }

        // Configure renderer
        $viewRenderer = $serviceManager->get('ViewRenderer');
        if (!$viewRenderer instanceof PhpRenderer) {
            return;
        }
        
        $this->configureView($viewRenderer);
    }

    /**
     * Configure view renderer
     *
     * @param PhpRenderer $viewRenderer
     */
    protected function configureView($viewRenderer)
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
