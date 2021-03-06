<?php

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormSelect as FormSelectHelper;

class FormSelect extends FormSelectHelper
{

    /**
     * @inheritDoc
     */
    public function render(ElementInterface $element)
    {
        $class = '';
        if ($element->hasAttribute('class')) {
            $class .= $element->getAttribute($class) . ' ';
        }
        $element->setAttribute('class', $class . 'form-control');
        if ($element->getOption('empty_option')) {
            $element->setOption('empty_option', '-- NONE --');
        }
        return parent::render($element);
    }
}
