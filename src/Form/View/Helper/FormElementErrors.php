<?php

namespace IseBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormElementErrors as FormElementErrorsHelper;

/**
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class FormElementErrors extends FormElementErrorsHelper
{

    /**
     * {@inheritDoc}
     */
    protected $messageCloseString = '</span>';

    /**
     * {@inheritDoc}
     */
    protected $messageOpenFormat = '<span class="help-block">';

    /**
     * {@inheritDoc}
     */
    protected $messageSeparatorString = '</span><span class="help-block">';
}
