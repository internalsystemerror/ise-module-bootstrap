<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\View\Helper;

class Label extends AbstractTypableHtmlElement
{

    /**
     * @var string
     */
    protected $element = 'span';

    /**
     * @var string[]
     */
    protected $class = ['label'];

    /**
     * @var array
     */
    protected $validTypes = [
        'default',
        'primary',
        'success',
        'info',
        'warning',
        'danger',
    ];

    /**
     * @var string
     */
    protected $defaultType = 'default';

    /**
     * @var string
     */
    protected $typePrefix = 'label-';

    /**
     * Render a primary label
     *
     * @param  string $message The label text
     *
     * @return string
     */
    public function primary($message): string
    {
        return $this->render($message, 'primary');
    }

    /**
     * Render a success label
     *
     * @param  string $message The label text
     *
     * @return string
     */
    public function success($message): string
    {
        return $this->render($message, 'success');
    }

    /**
     * Render an info label
     *
     * @param  string $message The label text
     *
     * @return string
     */
    public function info($message): string
    {
        return $this->render($message, 'info');
    }

    /**
     * Render a warning label
     *
     * @param  string $message The label text
     *
     * @return string
     */
    public function warning($message): string
    {
        return $this->render($message, 'warning');
    }

    /**
     * Render a danger label
     *
     * @param  string $message The label text
     *
     * @return string
     */
    public function danger($message): string
    {
        return $this->render($message, 'danger');
    }
}
