<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Factory;

use Interop\Container\ContainerInterface;
use Ise\Bootstrap\Listener\DispatchListener;
use Zend\ServiceManager\Factory\FactoryInterface;

class DispatchListenerFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): DispatchListener
    {
        return new $requestedName($container->get('ViewRenderer'));
    }
}
