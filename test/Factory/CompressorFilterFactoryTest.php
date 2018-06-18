<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace IseTest\Bootstrap\Form\View\Helper;

use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\Yui\JsCompressorFilter;
use Ise\Bootstrap\Factory\CompressorFilterFactory;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;

class CompressorFilterFactoryTest extends TestCase
{
    
    /**
     * @var CompressorFilterFactory
     */
    protected $factory;

    /**
     * Sets up the fixture
     */
    public function setUp()
    {
        $this->factory = new CompressorFilterFactory;
    }
    
    /**
     * Test create CSS compressor filter
     */
    public function testCreateCssCompressor()
    {
        $serviceManager = new ServiceManager();
        $compressor     = $this->factory->createService($serviceManager, null, CssCompressorFilter::class);
        
        $this->assertInstanceOf(CssCompressorFilter::class, $compressor);
    }
    
    /**
     * Test create JS compressor filter
     */
    public function testCreateJsCompressor()
    {
        $serviceManager = new ServiceManager();
        $compressor     = $this->factory->createService($serviceManager, null, JsCompressorFilter::class);
        
        $this->assertInstanceOf(JsCompressorFilter::class, $compressor);
    }
}
