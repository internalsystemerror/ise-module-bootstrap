<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Factory;

use Assetic\Filter\Yui\BaseCompressorFilter;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

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
     * @inheritdoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): BaseCompressorFilter
    {
        return new $requestedName($this->getYuiPath(), $this->getJavaPath());
    }

    /**
     * Get the java binary path
     *
     * @return string
     */
    protected function getJavaPath(): string
    {
        if (!self::$javaPath) {
            $isWindows      = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
            self::$javaPath = realpath(
                $isWindows ? self::JAVA_PATH_WINDOWS : self::JAVA_PATH_UNIX
            ) ?: '';
        }
        return self::$javaPath;
    }

    /**
     * Get the YUI compressor path
     *
     * @return string
     */
    protected function getYuiPath()
    {
        if (!self::$yuiPath) {
            self::$yuiPath = realpath('vendor/nervo/yuicompressor/yuicompressor.jar') ?: '';
        }
        return self::$yuiPath;
    }
}
