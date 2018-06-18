<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\Element;
use Zend\Form\Element\Button as ButtonElement;
use Zend\Form\Element\Radio as RadioElement;
use Zend\Form\Element\Submit as SubmitElement;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRadio;
use Zend\Form\View\Helper\FormRow as FormRowHelper;
use Zend\View\Renderer\PhpRenderer;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */

/**
 * Class FormRow
 *
 * @package Ise\Bootstrap\Form\View\Helper
 * @property PhpRenderer $view
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class FormRow extends FormRowHelper
{

    /**
     * @var FormDescription
     */
    protected $descriptionHelper;

    /**
     * @var string
     */
    protected $groupWrapper = '<div class="form-group%s" id="form-group-%s">%s</div>';

    /**
     * @var string
     */
    protected $controlWrapper = '<div class="form-controls" id="form-controls-%s">%s%s</div>';

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param  null|ElementInterface $element
     * @param  null|string           $labelPosition
     * @param  null|bool             $renderErrors
     * @param  null|string           $groupWrapper
     * @param  null|string           $controlWrapper
     *
     * @return string|FormRow
     */
    public function __invoke(
        ElementInterface $element = null,
        $labelPosition = null,
        $renderErrors = null,
        $groupWrapper = null,
        $controlWrapper = null
    ) {

        if (!$element) {
            return $this;
        }

        if ($labelPosition === null) {
            $labelPosition = self::LABEL_PREPEND;
        }

        $this->setLabelPosition($labelPosition);

        if ($renderErrors !== null) {
            $this->setRenderErrors($renderErrors);
        }

        /** @var Element $element */
        return $this->render($element, $groupWrapper, $controlWrapper);
    }

    /**
     * Get description helper
     *
     * @return FormDescription
     */
    public function getDescriptionHelper(): FormDescription
    {
        if (!$this->descriptionHelper) {
            $helper = $this->view->plugin('formdescription');
            if ($helper instanceof FormDescription) {
                $this->setDescriptionHelper($helper);
            }
        }
        return $this->descriptionHelper;
    }

    /**
     * Set description helper
     *
     * @param  FormDescription $descriptionHelper
     *
     * @return void
     */
    public function setDescriptionHelper(FormDescription $descriptionHelper): void
    {
        $descriptionHelper->setView($this->getView());
        $this->descriptionHelper = $descriptionHelper;
    }

    /**
     * Get group wrapper
     *
     * @return string
     */
    public function getGroupWrapper(): string
    {
        return $this->groupWrapper;
    }

    /**
     * Set group wrapper
     *
     * @param  string $groupWrapper
     *
     * @return void
     */
    public function setGroupWrapper(string $groupWrapper): void
    {
        $this->groupWrapper = $groupWrapper;
    }

    /**
     * Get control wrapper
     *
     * @return string
     */
    public function getControlWrapper(): string
    {
        return $this->controlWrapper;
    }

    /**
     * Set control wrapper
     *
     * @param  string $controlWrapper
     *
     * @return void
     */
    public function setControlWrapper(string $controlWrapper): void
    {
        $this->controlWrapper = $controlWrapper;
    }

    /**
     * Utility form helper that renders a label (if it exists), an element and errors
     *
     * @param  ElementInterface $element
     * @param  string           $groupWrapper
     * @param  string           $controlWrapper
     *
     * @return string
     */
    public function render(ElementInterface $element, $groupWrapper = null, string $controlWrapper = null): string
    {
        if (!$element instanceof Element) {
            return '';
        }

        if ($element instanceof RadioElement) {
            /** @var FormRadio $radioHelper */
            $radioHelper = $this->view->plugin('formRadio');
            $radioHelper->setLabelAttributes([
                'class' => 'radio',
            ]);
        }

        $elementString = $this->getElementHelper()->render($element);
        if ($this->renderErrors) {
            $elementString .= $this->getElementErrorsHelper()->render($element);
        }
        if ($element->getAttribute('type') === 'hidden') {
            return $elementString;
        }

        return $this->renderGroup($element, $elementString, $groupWrapper, $controlWrapper);
    }

    /**
     * Render group
     *
     * @param Element $element
     * @param string  $elementString
     * @param string  $groupWrapper
     * @param string  $controlWrapper
     *
     * @return string
     */
    public function renderGroup(
        Element $element,
        string $elementString,
        string $groupWrapper = null,
        string $controlWrapper = null
    ): string {
        $id      = (string)($element->getAttribute('id') ?: $element->getAttribute('name'));
        $control = $this->renderControl($element, $elementString, $id, $controlWrapper);
        return $this->renderGroupWrapper($element, $id, $control, $groupWrapper);
    }

    /**
     * Render label
     *
     * @param Element $element
     *
     * @return string
     */
    protected function renderLabel(Element $element): string
    {
        $label = $element->getLabel();
        if (null === $label) {
            $label = $element->getOption('label') ?: $element->getAttribute('label');
        }
        if ($label) {
            $element->setLabelAttributes(['class' => 'control-label']);
            return (string)$this->getLabelHelper()->__invoke($element, $label);
        }
        return '';
    }

    /**
     * Render control
     *
     * @param  Element $element
     * @param  string  $elementString
     * @param  string  $id
     * @param  string  $controlWrapper
     *
     * @return string
     */
    protected function renderControl(
        Element $element,
        string $elementString,
        string $id,
        string $controlWrapper = null
    ): string {
        $description = $this->getDescriptionHelper()->render($element);
        $label       = $this->renderLabel($element);
        $control     = $this->renderControlWrapper($id, $element, $elementString, $description, $controlWrapper);
        if ($label) {
            switch ($this->labelPosition) {
                case self::LABEL_PREPEND:
                    return $label . $control;
                case self::LABEL_APPEND:
                default:
                    return $control . $label;
            }
        }
        return $control;
    }

    /**
     * Render group wrapper
     *
     * @param  Element $element
     * @param  string  $id
     * @param  string  $control
     * @param  string  $wrapper
     *
     * @return string
     */
    protected function renderGroupWrapper(Element $element, string $id, string $control, string $wrapper = null): string
    {
        if (!$wrapper) {
            $wrapper = $this->groupWrapper;
        }
        $addErrorClass = $element->getMessages() ? ' has-error' : '';
        return sprintf($wrapper, $addErrorClass, $id, $control);
    }

    /**
     * Render control wrapper
     *
     * @param  string  $id
     * @param  Element $element
     * @param  string  $elementString
     * @param  string  $description
     * @param  string  $wrapper
     *
     * @return string
     */
    protected function renderControlWrapper(
        string $id,
        Element $element,
        string $elementString,
        string $description,
        string $wrapper = null
    ): string {
        if (!$wrapper) {
            if ($element instanceof ButtonElement || $element instanceof SubmitElement) {
                return $elementString . $description;
            }
            $wrapper = $this->controlWrapper;
        }
        return sprintf($wrapper, $id, $elementString, $description);
    }
}
