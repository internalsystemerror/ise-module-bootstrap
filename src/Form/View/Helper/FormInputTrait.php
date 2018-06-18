<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;

trait FormInputTrait
{

    /**
     * @inheritdoc
     */
    public function render(ElementInterface $element): string
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
