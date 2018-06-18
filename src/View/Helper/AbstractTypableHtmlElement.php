<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap\View\Helper;

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
     *
     * @return string|self
     */
    public function __invoke(string $content = null, string $type = null)
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
     * @param  array  $arguments
     *
     * @return string
     */
    public function __call(string $method, array $arguments): string
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
     *
     * @return void
     */
    public function addValidType(string $validType): void
    {
        $this->validTypes[] = $validType;
    }

    /**
     * Is type valid for this element
     *
     * @param  string $type The element type
     *
     * @return bool
     */
    public function isValidType(string $type): bool
    {
        return in_array($type, $this->validTypes);
    }

    /**
     * Get the valid types
     *
     * @return string[]
     */
    public function getValidTypes(): array
    {
        return $this->validTypes;
    }

    /**
     * Set the valid types
     *
     * @param  string[] $validTypes Indexed array of valid types
     *
     * @return void
     */
    public function setValidTypes(array $validTypes): void
    {
        $this->validTypes = $validTypes;
    }

    /**
     * Get type prefix
     *
     * @return string
     */
    public function getTypePrefix(): string
    {
        return $this->typePrefix;
    }

    /**
     * Set type prefix
     *
     * @param  string $typePrefix
     *
     * @return void
     */
    public function setTypePrefix(string $typePrefix): void
    {
        $this->typePrefix = $typePrefix;
    }

    /**
     * Get class array
     *
     * @return string[]
     */
    public function getClass(): array
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param  string $type
     *
     * @return void
     */
    public function setType(string $type): void
    {
        $this->checkType($type);
        $this->type = $type;
    }

    /**
     * Render label
     *
     * @param  string $content The content text
     * @param  string $type    Label type
     *
     * @return string
     */
    public function render(string $content = null, string $type = null): string
    {
        // Check variables
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
     *
     * @return void
     * @throws Exception\InvalidArgumentException
     */
    protected function checkType(string $type): void
    {
        if (!$this->isValidType($type)) {
            throw new Exception\InvalidArgumentException('"' . $type . '" is not a valid type');
        }
    }
}
