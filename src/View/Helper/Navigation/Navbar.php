<?php

namespace Ise\Bootstrap\View\Helper\Navigation;

use Zend\Navigation\AbstractContainer;
use Zend\Navigation\Page\AbstractPage;
use Zend\Navigation\Navigation;
use Zend\View\Exception;

/**
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class Navbar extends AbstractNavigation
{

    /**
     * @const integer Max render depth for bootstrap navbars (0 is root depth)
     */
    const MAX_RENDER_DEPTH = 1;

    /**
     * @var boolean
     */
    protected $inverse = false;

    /**
     * @var boolean|string
     */
    protected $fixed = false;

    /**
     * @var boolean
     */
    protected $static = false;

    /**
     * @var string
     */
    protected $brand = '';

    /**
     * @var boolean|string
     */
    protected $useForm = false;

    /**
     * @var boolean|string|AbstractContainer
     */
    protected $rightMenu = false;

    /**
     * @var string
     */
    protected $ulClass = 'nav navbar-nav';

    /**
     * Set inverse
     *
     * @param  boolean $inverse Whether to set the class navbar-inverse
     * @return Navbar
     */
    public function setInverse($inverse)
    {
        $this->inverse = (boolean) $inverse;
        return $this;
    }

    /**
     * Set fixed
     *
     * @param  string|boolean $fixed Whether to set the class navbar-fixed-???
     * @return Navbar
     * @throws Exception\InvalidArgumentException
     */
    public function setFixed($fixed)
    {
        if ($fixed !== false) {
            switch ($fixed) {
                case 'top':
                case 'bottom':
                    break;
                default:
                    throw new Exception\InvalidArgumentException(
                        'Only top and bottom are acceptable navbarFixed options'
                    );
            }
        }

        $this->fixed = $fixed;
        return $this;
    }

    /**
     * Set static
     *
     * @param  boolean $static Whether to set the class navbar-static-top
     * @return Navbar
     */
    public function setStatic($static)
    {
        $this->static = (boolean) $static;
        return $this;
    }

    /**
     * Set brand
     *
     * @param  string $brand The navbar brand to use
     * @return Navbar
     */
    public function setBrand($brand)
    {
        $this->brand = (string) $brand;
        return $this;
    }

    /**
     * Set use form
     *
     * @param  boolean|string $form Form to use or false for no form
     * @return Navbar
     */
    public function setUseForm($form)
    {
        $this->useForm = $form;
        return $this;
    }

    /**
     * Set right menu
     *
     * @param boolean|string|AbstractContainer $container Container to render or
     *                                                    false for no menu
     * @return Navbar
     */
    public function setRightMenu($container)
    {
        if (null === $container) {
            throw Exception\InvalidArgumentException(
                'Container must be a string alias or an instance of '
                . 'Zend\Navigation\AbstractContainer'
            );
        }
        $this->parseContainer($container);
        $this->rightMenu = $container;
        return $this;
    }

    /**
     * Normalise options
     *
     * @param  array $options Options to override the defaults
     * @return array
     */
    protected function normalizeOptions(array $options)
    {
        return array_merge(parent::normalizeOptions($options), [
            'inverse'   => $this->inverse,
            'fixed'     => $this->fixed,
            'static'    => $this->static,
            'brand'     => $this->brand,
            'useForm'   => $this->useForm,
            'rightMenu' => $this->rightMenu,
            ], $options);
    }

    /**
     * Render navbar container
     *
     * @param  AbstractContainer $container Container to create menu from.
     * @param  array             $options   Options for controlling rendering
     * @throws Exception\InvalidArgumentException
     */
    protected function renderNavigation(AbstractContainer $container, array $options)
    {
        // Start html
        $html = $this->renderNavbarContainerHeader($options)
            . $this->renderNavbarMenu($container, $options);

        // Add form if applicable
        if ($options['useForm']) {
            $html .= $this->renderNavbarForm($options);
        }

        // Add right aligned menu
        if ($options['rightMenu']) {
            $html .= $this->renderNavbarRightMenu($options);
        }

        // Finish html
        $html .= $this->renderNavbarContainerFooter();
        return $html;
    }

    /**
     * Render navbar container header
     *
     * @param  array $options Options for controlling rendering
     * @return string
     */
    protected function renderNavbarContainerHeader(array $options)
    {
        $class = $this->createNavbarContainerClass($options);
        $brand = $this->renderBrand($options);

        return <<<HTML
            <nav class="{$class}">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed"
                                data-toggle="collapse"
                                data-target="#isebootstrap-navbar"
                                aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        {$brand}
                    </div>
                    <div class="collapse navbar-collapse" id="isebootstrap-navbar">
HTML;
    }

    /**
     * Render navbar container footer
     *
     * @return string
     */
    protected function renderNavbarContainerFooter()
    {
        return '</div></div></nav>';
    }

    /**
     * Render brand
     *
     * @param  array $options Options for controlling rendering
     * @return string
     */
    protected function renderBrand(array $options)
    {
        $brandLabel = $options['brand'];
        $brandLink  = '#';
        if (is_array($options['brand'])) {
            if (isset($options['brand']['route'])) {
                $urlHelper = $this->view->plugin('url');
                $brandLink = $urlHelper($options['brand']['route']);
            } elseif (isset($options['brand']['uri'])) {
                $brandLink = $options['brand']['uri'];
            }
            
            $brandLabel = '';
            if (isset($options['brand']['icon'])) {
                $iconHelper = $this->getIconHelper();
                $brandLabel .= $iconHelper($options['brand']['icon']) . ' ';
            }
            $brandLabel .= $options['brand']['label'];
        }
        
        return '<a class="navbar-brand" href="' . $brandLink . '">'
            . $brandLabel . '</a>';
    }

    /**
     * Render navbar menu
     *
     * @param  AbstractContainer $container Container to render
     * @param  array             $options   Options for controlling rendering
     * @return string
     */
    protected function renderNavbarMenu(AbstractContainer $container, array $options)
    {
        // Create iterator
        $iterator = new \RecursiveIteratorIterator($container, \RecursiveIteratorIterator::SELF_FIRST);
        $iterator->setMaxDepth(self::MAX_RENDER_DEPTH);

        // Add pages
        $html      = '';
        $prevDepth = -1;
        foreach ($iterator as $page) {
            if (!$this->accept($page)) {
                continue;
            }
            // Create navbar page
            $depth = $iterator->getDepth();
            $html .= $this->renderNavbarMenuPage($page, $options, $depth, $prevDepth);

            // Store depth for next iteration
            $prevDepth = $depth;
        }

        // Check if any html was created
        if ($html) {
            // Close open ul/li tags
            for ($i = $prevDepth + 1; $i > 0; $i--) {
                $html .= '</li></ul>';
            }
        }

        return $html;
    }

    /**
     * Render navbar menu page
     *
     * @param  AbstractPage $page      Page to render
     * @param  array        $options   Options for controlling rendering
     * @param  integer      $depth     Current iteration depth
     * @param  integer      $prevDepth Previous iteration depth
     * @return string
     */
    protected function renderNavbarMenuPage(AbstractPage $page, array $options, $depth, $prevDepth)
    {
        // Check for depth
        $html = '';
        
        if ($depth > $prevDepth) {
            // Start new ul tag
            $ulClass = $this->createNavbarMenuClass($page, $options['ulClass'], $depth);
            $html .= '<ul' . $ulClass . '>';
        } elseif ($depth < $prevDepth) {
            // Close open li/ul tags until we're at current depth
            for ($i = $prevDepth; $i > $depth; $i--) {
                $html .= '</li></ul>';
            }
            // Close previous li tag
            $html .= '</li>';
        } elseif ($depth == $prevDepth) {
            // Close previous li tag
            $html .= '</li>';
        }

        // Check for divider
        if ($page->get('divider')) {
            $html .= '<li class="divider"></li>';
        }
        
        // Check if page is empty
        if ($this->isPageEmpty($page)) {
            return $html;
        }
        
        // Add menu item
        $liClass = $this->createNavbarMenuItemClass($page, $options['addClassToLi'], $depth);
        $html .= '<li' . $liClass . '>' . $this->htmlify(
            $page,
            $options['addClassToLi'],
            $options['iconPosition'],
            $depth >= self::MAX_RENDER_DEPTH
        );

        return $html;
    }
    
    /**
     * Is the page empty?
     *
     * @param  AbstractPage $page Page to check
     * @return boolean
     */
    protected function isPageEmpty(AbstractPage $page)
    {
        if ($page->get('route')) {
            return false;
        }
        
        if (!$page->hasPages(true)) {
            return true;
        }
        
        $isGranted = $this->getView()->plugin('isGranted');
        foreach ($page->getPages() as $childPage) {
            if (!$childPage->isVisible()) {
                continue;
            }
            
            if ($isGranted($childPage->get('permission'))) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Render navbar right aligned menu
     *
     * @param  array $options Options for controlling rendering
     * @return string
     */
    protected function renderNavbarRightMenu(array $options)
    {
        // Get container to use
        $container = $options['rightMenu'];
        $this->parseContainer($container);
        if (null === $container) {
            $container = new Navigation;
        }

        // Set option
        $options['ulClass'] .= ' navbar-right';

        return $this->renderNavbarMenu($container, $options);
    }

    /**
     * Render navbar form
     *
     * @param  array $options Options for controlling rendering
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function renderNavbarForm(array $options)
    {
        // Load form (must be ZendForm instance)
        // Load form view helper
        // Render form

        /**
         * For now not implemented
         */
        throw new \BadMethodCallException('This method is not yet implemented');
    }

    /**
     * Create navbar container class
     *
     * @param  array $options Options for controlling rendering
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    protected function createNavbarContainerClass(array $options)
    {
        // Create navbar container class
        $containerClass = 'navbar';
        if ($options['inverse']) {
            $containerClass .= ' navbar-inverse';
        }
        if ($options['fixed']) {
            $containerClass .= ' navbar-fixed-';
            switch ($options['fixed']) {
                case 'top':
                case 'bottom':
                    $containerClass .= $options['fixed'];
                    break;
                default:
                    throw new Exception\InvalidArgumentException(
                        'Only top and bottom are acceptable navbarFixed options'
                    );
            }
        }
        return $containerClass;
    }

    /**
     * Create navbar menu class
     *
     * @param  AbstractPage $page    Page being rendered
     * @param  string       $ulClass The ul class to set,
     * $param  integer      $depth   Current iteration depth
     * @return string
     */
    protected function createNavbarMenuClass(AbstractPage $page, $ulClass, $depth)
    {
        if ($depth === 0 && $ulClass) {
            return ' class="' . $this->escapeHtmlAttribute($ulClass) . '"';
        } elseif ($page->getParent() && $depth <= self::MAX_RENDER_DEPTH) {
            return ' class="dropdown-menu"';
        }

        return '';
    }

    /**
     * Create navbar menu item class
     *
     * @param  AbstractPage $page         Page being rendered
     * @param  boolean      $addClassToLi Whether to add the page class to the
     *                                    li, or leave it for the a
     * $param  integer      $depth        Current iteration depth
     * @return string
     */
    protected function createNavbarMenuItemClass(AbstractPage $page, $addClassToLi, $depth)
    {
        // Render li tag and page
        $liClasses = [];

        // Is page active
        if ($page->isActive()) {
            $liClasses[] = 'active';
        }

        // Does page have children
        if ($page->hasPages() && $depth < self::MAX_RENDER_DEPTH) {
            $liClasses[] = 'dropdown';
        }

        // Add page class
        if ($addClassToLi && $page->getClass()) {
            $liClasses[] = $page->getClass();
        }

        // Create li
        if ($liClasses) {
            return ' class="' . implode(' ', $liClasses) . '"';
        }

        return '';
    }
}
