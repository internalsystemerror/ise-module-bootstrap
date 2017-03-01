<?php

namespace IseTest\Bootstrap\Form\View\Helper;

use Ise\Bootstrap\Form\View\Helper\FormDescription;
use Zend\Form\Element;
use ZendTest\Form\View\Helper\CommonTestCase;

class FormDescriptionTest extends CommonTestCase
{

    /**
     * @var FormDescription
     */
    protected $object;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new FormDescription;
        parent::setUp();
    }

    /**
     * Test block wrapper default
     */
    public function testDefaultBlockWrapper()
    {
        $this->assertEquals('<p class="help-block">%s</p>', $this->object->getBlockWrapper());
    }

    /**
     * Test can change block wrapper
     */
    public function testChangeBlockWrapper()
    {
        $markup = '<p>%s</p>';
        $this->object->setBlockWrapper($markup);
        
        $this->assertEquals($markup, $this->object->getBlockWrapper());
    }

    /**
     * Test inline wrapper default
     */
    public function testDefaultInlineWrapper()
    {
        $this->assertEquals('<span class="help-inline">%s</span>', $this->object->getInlineWrapper());
    }

    /**
     * Test can change inline wrapper
     */
    public function testChangeInlineWrapper()
    {
        $markup = '<span>%s</span>';
        $this->object->setInlineWrapper($markup);
        
        $this->assertEquals($markup, $this->object->getInlineWrapper());
    }

    /**
     * Render element
     */
    public function testRenderBlock()
    {
        $element = new Element('foo');
        $text    = 'This is a help block';
        $element->setOption('help-block', $text);
        
        $markup  = $this->helper->render($element);
        $this->assertContains($text, $markup);
    }

    /**
     * Render element
     */
    public function testRenderBlockWithCustomWrapper()
    {
        $element = new Element('foo');
        $text    = 'This is block help';
        $wrapper = '<wrapper>%s</wrapper>';
        $element->setOption('help-block', $text);
        
        $markup = $this->helper->render($element, $wrapper);
        $this->assertEquals(sprintf($wrapper, $text), $markup);
    }

    /**
     * Render element
     */
    public function testRenderInline()
    {
        $element = new Element('foo');
        $text    = 'This is inline help';
        $element->setOption('help-inline', $text);
        
        $this->assertContains($text, $this->helper->render($element));
    }

    /**
     * Render element
     */
    public function testRenderInlineWithCustomWrapper()
    {
        $element = new Element('foo');
        $text    = 'This is inline help';
        $wrapper = '<wrapper>%s</wrapper>';
        $element->setOption('help-inline', $text);
        
        $markup = $this->helper->render($element, $wrapper);
        $this->assertEquals(sprintf($wrapper, $text), $markup);
    }
}
