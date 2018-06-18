<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;

class FormDescription extends AbstractHelper
{

    /**
     * @var string
     */
    protected $blockWrapper = '<p class="help-block">%s</p>';

    /**
     * @var string
     */
    protected $inlineWrapper = '<span class="help-inline">%s</span>';

    /**
     * Helper entry point
     *
     * @param  ElementInterface $element
     * @param  string           $blockWrapper
     * @param  string           $inlineWrapper
     *
     * @return string|self
     */
    public function __invoke(ElementInterface $element = null, $blockWrapper = null, $inlineWrapper = null)
    {
        if ($element) {
            return $this->render($element, $blockWrapper, $inlineWrapper);
        }
        return $this;
    }

    /**
     * Get block wrapper
     *
     * @return string
     */
    public function getBlockWrapper(): string
    {
        return $this->blockWrapper;
    }

    /**
     * Set block wrapper
     *
     * @param  string $blockWrapper
     *
     * @return void
     */
    public function setBlockWrapper($blockWrapper): void
    {
        $this->blockWrapper = (string)$blockWrapper;
    }

    /**
     * Get inline wrapper
     *
     * @return string
     */
    public function getInlineWrapper(): string
    {
        return $this->inlineWrapper;
    }

    /**
     * Set inline wrapper
     *
     * @param string $inlineWrapper
     *
     * @return void
     */
    public function setInlineWrapper($inlineWrapper): void
    {
        $this->inlineWrapper = (string)$inlineWrapper;
    }

    /**
     * Render description
     *
     * @param  ElementInterface $element
     * @param  string           $blockWrapper
     * @param  string           $inlineWrapper
     *
     * @return string
     */
    public function render(ElementInterface $element, $blockWrapper = null, $inlineWrapper = null): string
    {
        $html   = '';
        $inline = $element->getOption('help-inline');
        $block  = $element->getOption('help-block');
        if ($inline) {
            $html .= sprintf($inlineWrapper ?: $this->inlineWrapper, $inline);
        }
        if ($block) {
            $html .= sprintf($blockWrapper ?: $this->blockWrapper, $block);
        }
        return $html;
    }
}
