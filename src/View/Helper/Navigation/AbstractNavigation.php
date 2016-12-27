<?php

namespace Ise\Bootstrap\View\Helper\Navigation;

use Ise\Bootstrap\View\Helper\HtmlElementTrait;
use Ise\Bootstrap\View\Helper\Icon;
use Zend\Navigation\AbstractContainer;
use Zend\Navigation\Page\AbstractPage;
use Zend\View\Helper\Navigation\AbstractHelper as AbstractNavigationHelper;
use Zend\View\Exception;

abstract class AbstractNavigation extends AbstractNavigationHelper
{

    use HtmlElementTrait;

    /**
     * @const integer
     */
    const ICON_PREPEND = 0;

    /**
     * @const integer
     */
    const ICON_APPEND = 1;

    /**
     * @var Icon
     */
    protected $iconHelper;

    /**
     * @var string
     */
    protected $ulClass = 'nav';

    /**
     * @var boolean
     */
    protected $addClassToLi = false;

    /**
     * @var integer
     */
    protected $iconPosition = self::ICON_PREPEND;

    /**
     * Helper entry point
     *
     * @param  string|AbstractContainer $container Container to operate on
     * @return Navbar
     */
    public function __invoke($container = null)
    {
        if (null !== $container) {
            $this->setContainer($container);
        }
        return $this;
    }

    /**
     * Set ul class
     *
     * @param  string $ulClass Class to give to the main menu ul
     * @return Navbar
     */
    public function setUlClass($ulClass)
    {
        $this->ulClass = (string) $ulClass;
        return $this;
    }

    /**
     * Set add class to li
     *
     * @param  boolean $addClassToLi Whether to add the page class to the li, or
     *                               leave it for the a
     * @return Navbar
     */
    public function setAddClassToLi($addClassToLi)
    {
        $this->addClassToLi = (boolean) $addClassToLi;
        return $this;
    }

    /**
     * Set add class to li
     *
     * @param  boolean $iconPosition Icon position
     * @return Navbar
     */
    public function setIconPosition($iconPosition)
    {
        switch ($iconPosition) {
            case self::ICON_PREPEND:
            case self::ICON_APPEND:
                $this->iconPosition = $iconPosition;
                break;
            default:
                throw new Exception\InvalidArgumentException('Invalid icon position given');
        }
        return $this;
    }

    public function getIconHelper()
    {
        if (!$this->iconHelper) {
            $this->iconHelper = $this->getView()->plugin('icon');
            if (!$this->iconHelper instanceof Icon) {
                throw new Exception\RuntimeException('Helper not loaded: icon');
            }
        }
        return $this->iconHelper;
    }

    /**
     * Renders navbar
     *
     * Implements {@link HelperInterface::render()}.
     *
     * @param  AbstractContainer $container [Optional] Container to create menu
     *                                       from. Default is to use the
     *                                       container retrieved from
     *                                       {@link getContainer()}.
     * @param  array             $options   [Optional] Options for controlling
     *                                       rendering
     * @return string
     */
    public function render($container = null, array $options = [])
    {
        // Set up variables
        $this->parseContainer($container);
        if (null === $container) {
            $container = $this->getContainer();
        }

        // Render navbar container
        return $this->renderNavigation($container, $this->normalizeOptions($options));
    }

    /**
     * Returns an HTML string containing an 'a' element for the given page
     *
     * @param  AbstractPage $page         Page to render
     * @param  boolean      $addClassToLi Whether to add the page class to the
     *                                    li, or leave it for the element
     * @param  integer      $iconPosition Prepend or append the icon (if given)
     * @param  boolean      $isLast       Whether element should be considered
     *                                    the last child
     * @return string
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function htmlify(
        AbstractPage $page,
        $addClassToLi = false,
        $iconPosition = self::ICON_PREPEND,
        $isLast = false
    ) {
    
        // Render elements
        $this->setupAttributes($page, $addClassToLi, $isLast);
        $icon  = $this->renderIcon($page);
        $label = $this->renderLabel($page);

        // Build html
        $content = $this->renderContent($icon, $label, $iconPosition);
        if ($page->hasPages() && !$isLast) {
            $content .= ' <b class="caret"></b>';
        }

        // Finish html
        return $this->renderElement($content);
    }
    
    protected function renderContent($icon, $label, $iconPosition)
    {
        if ($iconPosition === self::ICON_PREPEND) {
            return $icon . ' ' . $label;
        } elseif ($iconPosition === self::ICON_APPEND) {
            return $label . ' ' . $icon;
        }
        throw new Exception\InvalidArgumentException('Invalid icon position given');
    }

    /**
     * Setup attributes
     *
     * @param  AbstractPage $page
     * @param  boolean      $addClassToLi
     * @return string
     */
    protected function setupAttributes(AbstractPage $page, $addClassToLi, $isLast)
    {
        // Set up element
        $this->setElement('a');
        $this->setId($page->getId());
        $this->setClass([]);
        $this->setAttributes([
            'title' => $this->translate($page->getTitle(), $page->getTextDomain())
        ]);

        // Set class
        if (!$addClassToLi) {
            $this->addClass($page->getClass());
        }

        // Check for button
        $button = $page->get('button');
        $this->setupButton($button, $page);
        if ($page->hasPages() && !$isLast) {
            $this->addClass('dropdown-toggle');
            $this->setAttribute('data-toggle', 'dropdown');
        }
    }
    
    /**
     * Setup button
     *
     * @param string $button
     * @param AbstractPage $page
     * @return null
     */
    protected function setupButton($button, $page)
    {
        if ($button) {
            $this->setElement('button');
            $this->addClass('btn');
            $this->addClass('btn-' . $button);
            $this->addClass('navbar-btn');
            $this->setAttribute('type', 'button');
            return;
        }
        
        // Add href
        $href = $page->getHref() ? : '#';
        if ($href !== '#') {
            $this->setAttribute('target', $page->getTarget());
        }
        $this->setAttribute('href', $href);
    }

    /**
     * Render page icon
     *
     * @param  AbstractPage $page Page to render icon for
     * @return string
     */
    protected function renderIcon($page)
    {
        $icon = $page->get('icon');
        if (!$icon) {
            return;
        }
        $iconHelper = $this->getIconHelper();
        return $iconHelper($icon);
    }

    /**
     * Render page label
     *
     * @param  AbstractPage $page Page to render label for
     * @return string
     */
    protected function renderLabel(AbstractPage $page)
    {
        $label = $this->translate($page->getLabel(), $page->getTextDomain());
        return $this->escapeHtml($label);
    }

    /**
     * Normalise options
     *
     * @param  array $options Options to override the defaults
     * @return array
     */
    protected function normalizeOptions(array $options)
    {
        return array_merge([
            'ulClass'      => $this->ulClass,
            'addClassToLi' => $this->addClassToLi,
            'iconPosition' => $this->iconPosition,
            ], $options);
    }

    /**
     * Render navigation
     *
     * @param  AbstractContainer $container Container to create html from.
     * @param  array             $options   Options for controlling rendering
     * @throws Exception\InvalidArgumentException
     */
    abstract protected function renderNavigation(AbstractContainer $container, array $options);
}
