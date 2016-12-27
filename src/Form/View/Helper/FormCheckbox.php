<?php

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormCheckbox as FormCheckboxHelper;

class FormCheckbox extends FormCheckboxHelper
{

    /**
     * @inheritDoc
     */
    public function render(ElementInterface $element)
    {
        return sprintf('<div class="checkbox">%s</div>', parent::render($element));
    }
}
