<?php

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Element\Button as ButtonElement;
use Zend\Form\Element\Radio as RadioElement;
use Zend\Form\Element\Submit as SubmitElement;
use Zend\Form\View\Helper\FormRow as FormRowHelper;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class FormRow extends FormRowHelper
{

    /**
     * @var SxBootstrap\View\Helper\Bootstrap\FormDescription
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

        return $this->render($element, $groupWrapper, $controlWrapper);
    }

    /**
     * Set description helper
     *
     * @param  FormDescription $descriptionHelper
     * @return FormElement
     */
    public function setDescriptionHelper(FormDescription $descriptionHelper)
    {
        $descriptionHelper->setView($this->getView());
        $this->descriptionHelper = $descriptionHelper;
        return $this;
    }

    /**
     * Get description helper
     *
     * @return FormDescription
     */
    public function getDescriptionHelper()
    {
        if (!$this->descriptionHelper) {
            $this->setDescriptionHelper($this->view->plugin('formdescription'));
        }
        return $this->descriptionHelper;
    }

    /**
     * Set group wrapper
     *
     * @param  string $groupWrapper
     * @return FormElement
     */
    public function setGroupWrapper($groupWrapper)
    {
        $this->groupWrapper = (string) $groupWrapper;
        return $this;
    }

    /**
     * Get group wrapper
     *
     * @return string
     */
    public function getGroupWrapper()
    {
        return $this->groupWrapper;
    }

    /**
     * Set control wrapper
     *
     * @param  string $controlWrapper
     * @return FormElement
     */
    public function setControlWrapper($controlWrapper)
    {
        $this->controlWrapper = (string) $controlWrapper;
        return $this;
    }

    /**
     * Get control wrapper
     *
     * @return string
     */
    public function getControlWrapper()
    {
        return $this->controlWrapper;
    }

    /**
     * Utility form helper that renders a label (if it exists), an element and errors
     *
     * @param  ElementInterface $element
     * @param  string           $groupWrapper
     * @param  string           $controlWrapper
     * @return string
     */
    public function render(ElementInterface $element, $groupWrapper = null, $controlWrapper = null)
    {
        $renderer = $this->getElementHelper()->getView();
        if (method_exists($renderer, 'plugin') && $element instanceof RadioElement) {
            $renderer->plugin('form_radio')->setLabelAttributes([
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
     * @param ElementInterface $element
     * @param string $elementString
     * @param string $groupWrapper
     * @param string $controlWrapper
     * @return string
     */
    public function renderGroup(
        ElementInterface $element,
        $elementString,
        $groupWrapper = null,
        $controlWrapper = null
    ) {
    
        $id      = $element->getAttribute('id') ? : $element->getAttribute('name');
        $control = $this->renderControl($element, $elementString, $id, $controlWrapper);
        return $this->renderGroupWrapper($element, $id, $control, $groupWrapper);
    }

    /**
     * Render label
     *
     * @param ElementInterface $element
     * @return string|null
     */
    protected function renderLabel(ElementInterface $element)
    {
        $label = $element->getLabel();
        if (null === $label) {
            $label = $element->getOption('label') ? : $element->getAttribute('label');
        }
        if ($label) {
            $element->setLabelAttributes(['class' => 'control-label']);
            return $this->getLabelHelper()->__invoke($element, $label);
        }
        return null;
    }

    /**
     * Render control
     *
     * @param  ElementInterface $element
     * @param  string           $elementString
     * @param  string           $id
     * @param  string           $controlWrapper
     * @return string
     */
    protected function renderControl(ElementInterface $element, $elementString, $id, $controlWrapper = null)
    {
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
     * @param  ElementInterface $element
     * @param  string           $id
     * @param  string           $control
     * @param  string           $wrapper
     * @return string
     */
    protected function renderGroupWrapper(ElementInterface $element, $id, $control, $wrapper = null)
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
     * @param  string           $id
     * @param  ElementInterface $element
     * @param  string           $elementString
     * @param  string           $description
     * @param  string           $wrapper
     * @return string
     */
    protected function renderControlWrapper($id, $element, $elementString, $description, $wrapper = null)
    {
        if (!$wrapper) {
            if ($element instanceof ButtonElement || $element instanceof SubmitElement) {
                return $elementString . $description;
            }
            $wrapper = $this->controlWrapper;
        }
        return sprintf($wrapper, $id, $elementString, $description);
    }
}
