<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Form\View\Helper;

use Ise\Bootstrap\View\Helper\Icon;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Zend\Form\LabelAwareInterface;
use Zend\Form\View\Helper\FormButton as ZendFormButton;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class FormButton
 *
 * @package Ise\Bootstrap\Form\View\Helper
 * @property PhpRenderer $view
 */
class FormButton extends ZendFormButton
{

    const TYPE_DEFAULT = 'default';
    const TYPES        = [
        'default',
        'primary',
        'success',
        'info',
        'warning',
        'danger',
        'link',
    ];

    /**
     * @var Icon
     */
    protected $iconHelper;

    /**
     * @var array
     */
    protected $validTagAttributes = [
        'name'           => true,
        'autofocus'      => true,
        'disabled'       => true,
        'form'           => true,
        'formaction'     => true,
        'formenctype'    => true,
        'formmethod'     => true,
        'formnovalidate' => true,
        'formtarget'     => true,
        'href'           => true,
        'type'           => true,
        'value'          => true,
    ];

    /**
     * {@inheritDoc}
     */
    public function render(ElementInterface $element, $buttonContent = null): string
    {
        // Setup button
        $this->setElementClass($element);
        $icon = $this->renderElementIcon($element);
        if ($icon) {
            $icon .= ' ';
        }

        // Render button
        $openTag = $this->openTag($element);
        if (null === $buttonContent) {
            $buttonContent = $element->getLabel() ?: $element->getValue();
            if (null === $buttonContent) {
                throw new Exception\DomainException(sprintf(
                    '%s expects either button content as the second argument, ' .
                    'or that the element provided has a label/value; none found',
                    __METHOD__
                ));
            }
            $element->setLabel(null);

            // Translate content
            $translator = $this->getTranslator();
            if (null !== $translator) {
                $buttonContent = $translator->translate($buttonContent, $this->getTranslatorTextDomain());
            }
        }

        // Escape content
        if (!$element instanceof LabelAwareInterface || !$element->getLabelOption('disable_html_escape')) {
            $escapeHtmlHelper = $this->getEscapeHtmlHelper();
            $buttonContent    = $escapeHtmlHelper($buttonContent);
        }
        $closeTag = $element->hasAttribute('href') ? '</a>' : $this->closeTag();

        return $openTag . $icon . $buttonContent . $closeTag;
    }

    /**
     * {@inheritDoc}
     */
    public function openTag($attributesOrElement = null): string
    {
        if (null === $attributesOrElement) {
            return '<button>';
        }

        if (is_array($attributesOrElement)) {
            $tag        = isset($attributesOrElement['href']) ? 'a' : 'button';
            $attributes = $this->createAttributesString($attributesOrElement);
            return sprintf('<%s %s>', $tag, $attributes);
        }

        if (!$attributesOrElement instanceof ElementInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects an array or Zend\Form\ElementInterface instance; received "%s"',
                __METHOD__,
                (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))
            ));
        }

        $element = $attributesOrElement;
        $name    = $element->getName();
        if (!$name) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        $attributes = (array)$element->getAttributes();
        $tag        = 'a';
        unset($attributes['type']);
        unset($attributes['value']);
        if (!isset($attributes['href'])) {
            $tag                 = 'button';
            $attributes['name']  = $name;
            $attributes['type']  = $this->getType($element);
            $attributes['value'] = $element->getValue();
        }

        return sprintf(
            '<%s %s>',
            $tag,
            $this->createAttributesString($attributes)
        );
    }

    /**
     * Get icon helper
     *
     * @return Icon
     * @throws Exception\ExtensionNotLoadedException
     */
    public function getIconHelper(): Icon
    {
        if (!$this->iconHelper) {
            $helper = $this->view->plugin('icon');
            if (!$helper instanceof Icon) {
                throw new Exception\ExtensionNotLoadedException('Helper not loaded: icon');
            }
            $this->iconHelper = $helper;
        }
        return $this->iconHelper;
    }

    /**
     * Render element icon
     *
     * @param  ElementInterface $element
     *
     * @return string
     */
    protected function renderElementIcon(ElementInterface $element): string
    {
        $render = '';
        $icon   = $element->getOption('icon');
        if ($icon) {
            $iconHelper = $this->getIconHelper();
            $render     = $iconHelper($icon);
        }
        return $render;
    }

    /**
     * Set element class
     *
     * @param  ElementInterface $element
     *
     * @return void
     * @throws Exception\DomainException
     */
    protected function setElementClass(ElementInterface $element): void
    {
        $class = $element->getAttribute('class');
        $type  = $element->getOption('type') ?: self::TYPE_DEFAULT;

        if (!in_array($type, self::TYPES, true)) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the button type is one of "' . implode('", "', self::TYPES) . '"',
                __METHOD__
            ));
        }

        if ($class) {
            $class .= ' ';
        }
        $class .= 'btn btn-' . $type;
        $element->setAttribute('class', $class);
    }
}
