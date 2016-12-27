<?php

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\Form as FormHelper;
use Zend\Form\FieldsetInterface;
use Zend\Form\FormInterface;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;

class Form extends FormHelper
{

    /**
     * {@inheritDoc}
     */
    public function render(FormInterface $form)
    {
        // Prepare form
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        // Create content
        $formContent = '';
        foreach ($form as $element) {
            switch (true) {
                case $element instanceof FieldsetInterface:
                    $formContent .= $this->getView()->formCollection($element);
                    break;
                default:
                    $formContent .= $this->getView()->formRow($element);
                    break;
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }
}
