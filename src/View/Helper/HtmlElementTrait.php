<?php

namespace Ise\Bootstrap\View\Helper;

use Ise\Bootstrap\View\Exception;
use Zend\Json\Json;
use Zend\View\Helper\EscapeHtml;
use Zend\View\Helper\EscapeHtmlAttr;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
trait HtmlElementTrait
{

    /**
     * @var EscapeHtml
     */
    protected $escapeHtmlHelper;

    /**
     * @var EscapeHtmlAttr
     */
    protected $escapeHtmlAttrHelper;

    /**
     * @var string
     */
    protected $element = '';

    /**
     * @var string[]
     */
    protected $attributes = [];

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var string[]
     */
    protected $class = [];

    /**
     * Helper entry point
     *
     * @param  string|null $content The content text
     * @return self
     */
    public function __invoke($content = null)
    {
        if ($content) {
            return $this->render($content);
        }
        return $this;
    }

    /**
     * Render element
     *
     * @param  string|null $content The content text
     * @return string
     */
    public function render($content)
    {
        // Check content
        $this->checkContent($content);

        // Render html
        return $this->renderElement($content);
    }

    /**
     * Escape html using view helper
     *
     * @param  string $text
     * @return string
     */
    public function escapeHtml($text)
    {
        if (!$this->escapeHtmlHelper) {
            $this->escapeHtmlHelper = $this->getView()->plugin('escapehtml');
            if (!$this->escapeHtmlHelper instanceof EscapeHtml) {
                throw new Exception\RuntimeException('Helper not loaded: escapeHtml');
            }
        }
        return $this->escapeHtmlHelper->__invoke($text);
    }

    /**
     * Escape html attribute using view helper
     *
     * @param  string $attribute
     * @return string
     */
    public function escapeHtmlAttribute($attribute)
    {
        if (!$this->escapeHtmlAttrHelper) {
            $this->escapeHtmlAttrHelper = $this->getView()->plugin('escapehtmlattr');
            if (!$this->escapeHtmlAttrHelper instanceof EscapeHtmlAttr) {
                throw new Exception\RuntimeException('Helper not loaded: escapeHtmlAttr');
            }
        }
        return $this->escapeHtmlAttrHelper->__invoke($attribute);
    }

    /**
     * Set element
     *
     * @param  string $element
     * @return self
     */
    public function setElement($element)
    {
        $this->element = (string) $element;
        return $this;
    }

    /**
     * Get element
     *
     * @return string
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * Set element id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = (string) $id;
        return $this;
    }

    /**
     * Get element id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add a class to this element
     *
     * @param  string $class
     * @return self
     */
    public function addClass($class)
    {
        $this->class[] = (string) $class;
        return $this;
    }

    /**
     * Remove a class from this element
     *
     * @param  string $class
     * @return self
     */
    public function removeClass($class)
    {
        $index = array_search((string) $class, $this->class);
        if ($index !== false) {
            unset($this->class[$index]);
        }
        return $this;
    }

    /**
     * Set class array
     *
     * @param  string[] $class
     * @return self
     */
    public function setClass(array $class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * Get class array
     *
     * @return string[]
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get element class as string
     *
     * @return string
     */
    public function getClassAsString()
    {
        return $this->escapeHtmlAttribute(implode(' ', $this->getClass()));
    }

    /**
     * Set an attribute on this element
     *
     * @param  string $key
     * @param  string $valueue
     * @return self
     */
    public function setAttribute($key, $valueue)
    {
        if ($key === 'class') {
            $this->setClass([$valueue]);
        }
        $this->attributes[$key] = $valueue;
        return $this;
    }

    /**
     * Remove an attribute from this element
     *
     * @param  string $key
     * @return self
     */
    public function removeAttribute($key)
    {
        if (isset($this->attributes[$key])) {
            if ($key === 'class') {
                $this->setClass([]);
            }
            unset($this->attributes[$key]);
        }
        return $this;
    }

    /**
     * Set attribute associative array
     *
     * @param  string[] $attributes
     * @return self
     */
    public function setAttributes($attributes)
    {
        if (isset($attributes['class'])) {
            $class = $attributes['class'];
            $this->setClass([$class]);
            unset($attributes['class']);
        }
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * Get single attribute for this element
     *
     * @param  string $key
     * @return string
     */
    public function getAttribute($key)
    {
        if ($key === 'class') {
            return $this->getClass();
        }
        return $this->attributes[$key];
    }

    /**
     * Get attribute associative array
     *
     * @return string[]
     */
    public function getAttributes()
    {
        $id         = $this->getId();
        $attributes = $this->attributes;
        $class      = implode(' ', $this->getClass());
        if ($id) {
            $attributes['id'] = $this->normalizeId($id);
        }
        if ($class) {
            $attributes['class'] = $class;
        }
        return $attributes;
    }

    /**
     * Get element attributes as a string
     *
     * @return string
     */
    public function getAttributesAsString()
    {
        return $this->htmlAttribs($this->getAttributes());
    }

    /**
     * Checks the content
     *
     * @param  string|null $content The content text
     * @throws Exception\InvalidArgumentException
     */
    protected function checkContent($content)
    {
        if (!is_string($content) && !is_null($content)) {
            throw new Exception\InvalidArgumentException('The content must be a string if set');
        }
    }

    /**
     * Render html element
     *
     * @param  string $content
     * @return string
     */
    protected function renderElement($content = null)
    {
        // Get element parts
        $element    = $this->getElement();
        $attributes = $this->getAttributesAsString();

        // Create html
        $html = '<' . $element;
        if ($attributes) {
            $html .= $attributes;
        }

        // Create closing tag
        if (is_string($content)) {
            $html .= '>' . $content . '</' . $element;
        }
        $html .= $this->getClosingBracket();

        return $html;
    }

    /**
     * Converts an associative array to a string of tag attributes.
     *
     * @access public
     *
     * @param array $attribs From this array, each key-value pair is
     * converted to an attribute name and value.
     *
     * @return string The XHTML for the attributes.
     */
    protected function htmlAttribs($attribs)
    {
        $html           = '';
        $escapeHtml     = $this->getView()->plugin('escapehtml');
        $escapeHtmlAttr = $this->getView()->plugin('escapehtmlattr');

        foreach ((array) $attribs as $key => $value) {
            $key = $escapeHtml($key);
            $this->cleanHtmlAttribValue($key, $value);
            if (!$value) {
                continue;
            }

            switch ($key) {
                case 'class':
                case 'href':
                    $value = $escapeHtml($value);
                    break;
                default:
                    $value = $escapeHtmlAttr($value);
                    break;
            }

            if ('id' == $key) {
                $value = $this->normalizeId($value);
            }
            
            $html .= $this->getKeyValuePair($key, $value);
        }

        return $html;
    }
    
    /**
     * Get key value pair string
     *
     * @param  string $key   The parameter key
     * @param  string $value The parameter value
     * @return string
     */
    protected function getKeyValuePair($key, $value)
    {
        if (strpos($value, '"') !== false) {
            return ' ' . $key . '=\'' . $value . '\'';
        }
        return ' ' . $key . '="' . $value . '"';
    }

    /**
     * Cleans html attribute value accordingly
     *
     * @param  string $key
     * @param  string $value
     * @return string
     */
    protected function cleanHtmlAttribValue($key, $value)
    {
        return trim($this->getHtmlAttribValue($key, $value));
    }
    
    /**
     * Get html attribute value
     *
     * @param  string $key
     * @param  string $value
     * @return string
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function getHtmlAttribValue($key, $value)
    {
        if (('on' == substr($key, 0, 2)) || ('constraints' == $key)) {
            // Don't escape event attributes; _do_ substitute double quotes with singles
            if (!is_scalar($value)) {
                // Non-scalar data should be cast to JSON first
                return Json::encode($value);
            }
            return $value;
        }
        
        if (is_array($value)) {
            return implode(' ', $value);
        }
        
        return $value;
    }
}
