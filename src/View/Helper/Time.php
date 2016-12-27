<?php

namespace Ise\Bootstrap\View\Helper;

use DateTime;

class Time extends AbstractHtmlElement
{

    /**
     * DateTime formats
     */
    const FORMAT_TIMESTAMP = 'c';
    const FORMAT_READABLE  = 'l, jS m Y H:ia T';

    /**
     * @var string
     */
    protected $element = 'time';

    /**
     * @var string[]
     */
    protected $class = ['timeago'];

    /**
     * Helper entry point
     *
     * @param  string|DateTime $time The time to render
     * @return self
     */
    public function __invoke($time = null)
    {
        if ($time) {
            return $this->render($time);
        }
        return $this;
    }

    /**
     * Render time
     *
     * @param  string|DateTime $time The time to render
     * @return string
     */
    public function render($time)
    {
        $timestamp = $readable = $time;
        if ($time instanceof DateTime) {
            $timestamp = $time->format(self::FORMAT_TIMESTAMP);
            $readable  = $time->format(self::FORMAT_READABLE);
        }

        // Render html
        $this->setAttribute('datetime', $timestamp);
        return $this->renderElement($readable);
    }
}
