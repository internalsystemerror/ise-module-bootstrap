<?php

namespace Ise\Bootstrap\Factory;

use Assetic\Filter\Yui\BaseCompressorFilter;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class CompressorFilterFactory implements FactoryInterface
{

    const JAVA_PATH_WINDOWS = 'C:\ProgramData\Oracle\Java\javapath\java.exe';
    const JAVA_PATH_UNIX    = '/usr/bin/java';

    /**
     * @var string
     */
    protected static $javaPath = '';

    /**
     * @var string
     */
    protected static $yuiPath = '';

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
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName($this->getYuiPath(), $this->getJavaPath());
    }

    /**
     * {@inheritDoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }

    protected function getJavaPath()
    {
        if (!self::$javaPath) {
            $isWindows      = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
            self::$javaPath = realpath(
                $isWindows ? self::JAVA_PATH_WINDOWS : self::JAVA_PATH_UNIX
            );
        }
        return self::$javaPath;
    }

    protected function getYuiPath()
    {
        if (!self::$yuiPath) {
            self::$yuiPath = realpath('vendor/nervo/yuicompressor/yuicompressor.jar');
        }
        return self::$yuiPath;
    }
}
