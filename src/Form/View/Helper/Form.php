<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\Form\View\Helper;

use Zend\Form\FieldsetInterface;
use Zend\Form\Form as ZendForm;
use Zend\Form\FormInterface;
use Zend\Form\View\Helper\Form as FormHelper;
use Zend\Form\View\Helper\FormCollection;
use Zend\View\Exception\InvalidHelperException;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class Form
 *
 * @package Ise\Bootstrap\Form\View\Helper
 * @property PhpRenderer $view
 */
class Form extends FormHelper
{

    /**
     * @var FormCollection
     */
    protected $formCollectionHelper;

    /**
     * @var FormRow
     */
    protected $formRowHelper;

    /**
     * {@inheritDoc}
     */
    public function render(FormInterface $form): string
    {
        // Prepare form
        if ($form instanceof ZendForm) {
            $form->prepare();
        }

        // Create content
        $formContent = '';
        foreach ($form as $element) {
            switch (true) {
                case $element instanceof FieldsetInterface:
                    $formContent .= $this->getFormCollectionHelper()($element);
                    break;
                default:
                    $formContent .= $this->getFormRowHelper()($element);
                    break;
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }

    /**
     * Get formCollection helper
     *
     * @return FormCollection
     * @throws InvalidHelperException
     */
    protected function getFormCollectionHelper(): FormCollection
    {
        if (!$this->formCollectionHelper) {
            $helper = $this->view->plugin('formCollection');
            if (!$helper instanceof FormCollection) {
                throw new InvalidHelperException('Unable to find helper: formCollection');
            }
            $this->formCollectionHelper = $helper;
        }

        return $this->formCollectionHelper;
    }

    /**
     * Get formRow helper
     *
     * @return FormRow
     * @throws InvalidHelperException
     */
    protected function getFormRowHelper(): FormRow
    {
        if (!$this->formRowHelper) {
            $helper = $this->view->plugin('formRow');
            if (!$helper instanceof FormRow) {
                throw new InvalidHelperException('Unable to find helper: formRow');
            }
            $this->formRowHelper = $helper;
        }

        return $this->formRowHelper;
    }
}
