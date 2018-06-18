<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;

class DispatchListener implements ListenerAggregateInterface
{

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * @var RendererInterface
     */
    protected $viewRenderer;

    /**
     * DispatchListener constructor
     *
     * @param RendererInterface $viewRenderer
     */
    public function __construct(RendererInterface $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1): void
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH,
            [$this, 'setupLayout'],
            $priority
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH_ERROR,
            [$this, 'setupLayout'],
            $priority
        );
    }

    /**
     * {@inheritDoc}
     */
    public function detach(EventManagerInterface $eventManager): void
    {
        foreach ($this->listeners as $index => $listener) {
            $eventManager->detach($listener);
        }
    }

    /**
     * Load view parameters
     *
     * @param MvcEvent $event
     *
     * @return void
     */
    public function setupLayout(MvcEvent $event): void
    {
        $viewModel = $event->getResult();
        if (!$this->viewRenderer instanceof PhpRenderer
            || !$viewModel instanceof ViewModel
            || $viewModel->terminate()
        ) {
            return;
        }
        $this->configureView();
    }

    /**
     * Configure view
     *
     * @return void
     */
    protected function configureView(): void
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
            $basePath . '/js/fix/ltIE9.js',
            'text/javascript',
            ['conditional' => 'lt IE 9']
        );
        $this->viewRenderer->inlineScript()->setAllowArbitraryAttributes(true)->appendFile($basePath . '/js/master.js');
    }
}
