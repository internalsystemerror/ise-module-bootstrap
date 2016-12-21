<?php

namespace IseBootstrap\View\Helper;

/**
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
class Alert extends AbstractTypableHtmlElement
{

    /**
     * @var string
     */
    protected $element = 'div';

    /**
     * @var string[]
     */
    protected $class = ['alert'];

    /**
     * @var string[]
     */
    protected $attributes = ['role' => 'alert'];

    /**
     * @var array
     */
    protected $validTypes = [
        'success',
        'info',
        'warning',
        'danger',
    ];

    /**
     * @var string
     */
    protected $typePrefix = 'alert-';

    /**
     * @var string
     */
    protected $defaultType = 'info';

    /**
     * Helper entry point
     *
     * @param  string  $message     The alert text
     * @param  string  $type        Alert level
     * @param  boolean $dismissable Include a close button
     * @return Alert
     */
    public function __invoke($message = '', $type = 'info', $dismissable = false)
    {
        if ($message) {
            return $this->render($message, $type, $dismissable);
        }
        return $this;
    }

    /**
     * Render a success alert
     *
     * @param  string  $message     The alert text
     * @param  boolean $dismissable Include a close button
     * @return string
     */
    public function success($message, $dismissable = false)
    {
        return $this->render($message, 'success', $dismissable);
    }

    /**
     * Render an info alert
     *
     * @param  string  $message     The alert text
     * @param  boolean $dismissable Include a close button
     * @return string
     */
    public function info($message, $dismissable = false)
    {
        return $this->render($message, 'info', $dismissable);
    }

    /**
     * Render a warning alert
     *
     * @param  string  $message     The alert text
     * @param  boolean $dismissable Include a close button
     * @return string
     */
    public function warning($message, $dismissable = false)
    {
        return $this->render($message, 'warning', $dismissable);
    }

    /**
     * Render a danger alert
     *
     * @param  string  $message     The alert text
     * @param  boolean $dismissable Include a close button
     * @return string
     */
    public function danger($message, $dismissable = false)
    {
        return $this->render($message, 'danger', $dismissable);
    }

    /**
     * Render alert
     *
     * @param  string  $message     The alert text
     * @param  string  $type        Alert type
     * @param  boolean $dismissable Include a close button
     * @return string
     */
    public function render($message, $type = 'info', $dismissable = false)
    {
        if ($dismissable) {
            $message .= $this->renderCloseButton();
        }

        return parent::render($message, $type);
    }

    /**
     * Renders the close button
     *
     * @return string
     */
    protected function renderCloseButton()
    {
        return '<button type="button" class="close" data-dismiss="alert" '
            . 'aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    }
}
