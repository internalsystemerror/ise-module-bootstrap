<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\View\Helper;

class Badge extends AbstractHtmlElement
{

    /**
     * @var string
     */
    protected $element = 'span';

    /**
     * @var string[]
     */
    protected $class = ['badge'];
}
