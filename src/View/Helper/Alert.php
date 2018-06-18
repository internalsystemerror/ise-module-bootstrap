<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\View\Helper;

/**
 * @SuppressWarnings(PHPMD.boolArgumentFlag)
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
     * @param  string $message     The alert text
     * @param  string $type        Alert level
     * @param  bool   $dismissible Include a close button
     *
     * @return self|string
     */
    public function __invoke($message = null, $type = 'info', $dismissible = false)
    {
        if ($message) {
            return $this->render($message, $type, $dismissible);
        }
        return $this;
    }

    /**
     * Render a success alert
     *
     * @param  string $message     The alert text
     * @param  bool   $dismissible Include a close button
     *
     * @return string
     */
    public function success($message, $dismissible = false): string
    {
        return $this->render($message, 'success', $dismissible);
    }

    /**
     * Render an info alert
     *
     * @param  string $message     The alert text
     * @param  bool   $dismissible Include a close button
     *
     * @return string
     */
    public function info($message, $dismissible = false): string
    {
        return $this->render($message, 'info', $dismissible);
    }

    /**
     * Render a warning alert
     *
     * @param  string $message     The alert text
     * @param  bool   $dismissible Include a close button
     *
     * @return string
     */
    public function warning($message, $dismissible = false): string
    {
        return $this->render($message, 'warning', $dismissible);
    }

    /**
     * Render a danger alert
     *
     * @param  string $message     The alert text
     * @param  bool   $dismissible Include a close button
     *
     * @return string
     */
    public function danger($message, $dismissible = false): string
    {
        return $this->render($message, 'danger', $dismissible);
    }

    /**
     * Render alert
     *
     * @param  string $message     The alert text
     * @param  string $type        Alert type
     * @param  bool   $dismissible Include a close button
     *
     * @return string
     */
    public function render($message, $type = 'info', $dismissible = false): string
    {
        if ($dismissible) {
            $message .= $this->renderCloseButton();
        }

        return parent::render($message, $type);
    }

    /**
     * Renders the close button
     *
     * @return string
     */
    protected function renderCloseButton(): string
    {
        return '<button type="button" class="close" data-dismiss="alert" '
               . 'aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    }
}
