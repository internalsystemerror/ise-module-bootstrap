<?php

namespace Ise\Bootstrap\Factory;

use Assetic\Filter\Yui\BaseCompressorFilter;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class CompressorFilterFactory implements FactoryInterface
{
    
    /**
     * @var string
     */
    protected $filterClass = '';
    
    /**
     * Create the BaseCompressorFilter instance
     *
     * @param ContainerInterface $container
     * @param type $requestedName
     * @return BaseCompressorFilter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Set paths
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $javaPath = 'C:\ProgramData\Oracle\Java\javapath\java.exe';
        } else {
            $javaPath = '/usr/bin/java';
        }
        $yuiPath = realpath('vendor/nervo/yuicompressor/yuicompressor.jar');
        
        return new $requestedName($yuiPath, $javaPath);
    }
    
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }
}
