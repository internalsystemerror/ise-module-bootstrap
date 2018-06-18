<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\FieldsetInterface;
use Zend\Form\FormInterface;
use Zend\Form\View\Helper\Form as FormHelper;

class Form extends FormHelper
{

    /**
     * {@inheritDoc}
     */
    public function render(FormInterface $form): string
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
