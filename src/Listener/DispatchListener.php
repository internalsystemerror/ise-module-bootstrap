<?php

namespace Ise\Bootstrap\View\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Router\Http\RouteMatch;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;

class DispatchListener implements ListenerAggregateInterface
{

    /**
     * @var array
     */
    protected $listeners = [];

    public function __construct(RendererInterface $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = -1000)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH,
                                             [$this, 'setupLayout'], $priority);
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
     * @param MvcEvent $event
     */
    public function setupLayout(MvcEvent $event)
    {
        $match      = $event->getRouteMatch();
        $controller = $event->getResult();
        if (!$this->viewRenderer instanceof PhpRenderer || !$match instanceof RouteMatch || !$controller instanceof AbstractController || $controller->terminate()) {
            return;
        }
        $this->configureView();
    }

    /**
     * Configure view
     */
    protected function configureView()
    {
        // Set meta data
        $this->viewRenderer->headMeta()->setCharset('UTF-8')
            ->appendName('viewport', 'width=device-width, initial-scale=1.0')
            ->appendHttpEquiv('X-UA-Compatible', 'IE=edge');
        $this->viewRenderer->headTitle()->setSeparator(' :: ')->setAutoEscape(false);

        // Add stylesheets
        $basePath = $this->viewRenderer->basePath();
        $this->viewRenderer->headLink([
            'rel'  => 'shortcut icon',
            'type' => 'image/vnd.microsoft.icon',
            'href' => $basePath . '/favicon.ico',
        ])->appendStylesheet($basePath . '/css/master.css');

        // Add scripts
        $this->viewRenderer->headScript()->setAllowArbitraryAttributes(true)->appendFile(
            $basePath . '/js/fix/ltIE9.js', 'text/javascript',
            ['conditional' => 'lt IE 9']
        );
        $this->viewRenderer->inlineScript()->setAllowArbitraryAttributes(true)->appendFile($basePath . '/js/master.js');
    }
}
