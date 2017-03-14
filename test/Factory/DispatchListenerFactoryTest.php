<?php

namespace IseTest\Bootstrap\Form\View\Helper;

use Ise\Bootstrap\Factory\DispatchListenerFactory;
use Ise\Bootstrap\Listener\DispatchListener;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Renderer\PhpRenderer;

class DispatchListenerFactoryTest extends TestCase
{

    /**
     * Sets up the fixture
     */
    public function setUp()
    {
        $this->object = new DispatchListenerFactory;
    }
    
    /**
     * Test create CSS compressor filter
     */
    public function testCreateDispatchListener()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('ViewRenderer', new PhpRenderer);
        
        $listener = $this->object->createService($serviceManager, null, DispatchListener::class);
        
        $this->assertInstanceOf(DispatchListener::class, $compressor);
    }
}
