<?php

namespace IseBootstrap\View\Helper;

use Zend\View\Exception;

abstract class AbstractTypableHtmlElement extends AbstractHtmlElement
{

    /**
     * @var string[]
     */
    protected $validTypes = [];

    /**
     * @var string
     */
    protected $typePrefix = '';

    /**
     * @var string|false
     */
    protected $defaultType = false;

    /**
     * @var string
     */
    protected $type = '';

    /**
     * Helper entry point
     *
     * @param  string $content The content text
     * @param  string $type    Label level
     * @return string|self
     */
    public function __invoke($content = null, $type = '')
    {
        if ($content) {
            return $this->render($content, $type);
        }
        return $this;
    }

    /**
     * Magic call method, proxies to render
     *
     * @param  string $method
     * @param  array $arguments
     * @return string
     */
    public function __call($method, $arguments)
    {
        // Throw exception if not valid
        $this->checkType($method);

        // Proxy to render with new arguments
        return $this->render($arguments[0], $method);
    }

    /**
     * Add a valid type
     *
     * @param  string $validType Valid type to add
     * @return self
     */
    public function addValidType($validType)
    {
        $this->validTypes[] = (string) $validType;
        return $this;
    }

    /**
     * Set the valid types
     *
     * @param  string[] $validTypes Indexed array of valid types
     * @return self
     */
    public function setValidTypes(array $validTypes)
    {
        $this->validTypes = $validTypes;
        return $this;
    }

    /**
     * Is type valid for this element
     *
     * @param  string $type The element type
     * @return boolean
     */
    public function isValidType($type)
    {
        return in_array($type, $this->validTypes, true);
    }

    /**
     * Get the valid types
     *
     * @return string[]
     */
    public function getValidTypes()
    {
        return $this->validTypes;
    }

    /**
     * Set type prefix
     *
     * @param  string $typePrefix
     * @return self
     */
    public function setTypePrefix($typePrefix)
    {
        $this->typePrefix = (string) $typePrefix;
        return $this;
    }

    /**
     * Get type prefix
     *
     * @return string
     */
    public function getTypePrefix()
    {
        return $this->typePrefix;
    }

    /**
     * Set type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->checkType($type);
        $this->type = $type;
        return $this;
    }

    /**
     * Get class array
     *
     * @return string[]
     */
    public function getClass()
    {
        $type  = $this->getType();
        $class = $this->class;
        if ($type) {
            $class[] = $this->getTypePrefix() . $type;
        }
        return $class;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Render label
     *
     * @param  string $content The content text
     * @param  string $type    Label type
     * @return string
     */
    public function render($content, $type = '')
    {
        // Check variables
        $this->checkContent($content);
        if (!$type) {
            if ($this->defaultType !== false) {
                $type = $this->defaultType;
            }
        }
        $this->setType($type);

        // Render html
        return $this->renderElement($content);
    }

    /**
     * Checks the type
     *
     * @param  string $type Element type
     * @throws Exception\InvalidArgumentException
     */
    protected function checkType($type)
    {
        if (!$this->isValidType($type)) {
            throw new Exception\InvalidArgumentException('"' . $type . '" is not a valid type');
        }
    }
}
