<?php

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;

trait FormInputTrait
{

    /**
     * Render a form <input> element from the provided $element
     *
     * @param  ElementInterface $element
     * @throws Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        // Set class
        $class = $element->getAttribute('class');
        if ($class) {
            $class .= ' ';
        }
        $element->setAttribute('class', $class . 'form-control');

        // Set placeholder
        $placeholder = $element->getAttribute('placeholder');
        if (!$placeholder) {
            $element->setAttribute('placeholder', $element->getLabel());
        }

        return parent::render($element);
    }
}
