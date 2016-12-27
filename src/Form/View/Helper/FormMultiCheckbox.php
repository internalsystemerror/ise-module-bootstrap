<?php

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\Element\MultiCheckbox;
use Zend\Form\View\Helper\FormMultiCheckbox as FormMultiCheckboxHelper;

class FormMultiCheckbox extends FormMultiCheckboxHelper
{

    /**
     * @var string
     */
    protected $separator = '</div><div class="checkbox">';

    /**
     * @inheritDoc
     */
    protected function renderOptions(MultiCheckbox $element, array $options, array $selectedOptions, array $attributes)
    {
        foreach ($options as $key => $optionSpec) {
            if (isset($optionSpec['attributes']['disabled'])) {
                $options[$key]['disabled'] = $optionSpec['attributes']['disabled'];
            }
            if (isset($optionSpec['attributes']['checked'])) {
                $options[$key]['selected'] = $optionSpec['attributes']['checked'];
            }
        }
        return sprintf('<div class="checkbox">%s</div>', parent::renderOptions($element, $options, $selectedOptions, $attributes));
    }
}
