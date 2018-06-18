<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\View\Helper;

use Zend\View\Helper\AbstractHtmlElement as ZendAbstractHtmlElement;

abstract class AbstractHtmlElement extends ZendAbstractHtmlElement
{

    use HtmlElementTrait;
}
