<<<<<<< Updated upstream
<?php

namespace IseTest\Bootstrap\Form\View\Helper;

use Ise\Bootstrap\Form\View\Helper\FormButton;
use ZendTest\Form\View\Helper\CommonTestCase;
use ZendTest\Form\View\Helper\FormButtonTest as ZendFormButtonTest;

class FormButtonTest extends ZendFormButtonTest
{

    /**
     * @var FormButton
     */
    protected $helper;

    /**
     * Sets up the fixture
     */
    public function setUp()
    {
        $this->helper = new FormButton;
        CommonTestCase::setUp();
    }
    
    /**
     * {@inheritDoc}
     */
    public function validAttributes()
    {
        return [
            ['href', 'assertContains'],
        ];
    }
}
=======
<?php

namespace IseTest\Bootstrap\Form\View\Helper;

use Ise\Bootstrap\Form\View\Helper\FormButton;
use ZendTest\Form\View\Helper\CommonTestCase;
use ZendTest\Form\View\Helper\FormButtonTest as ZendFormButtonTest;

class FormButtonTest extends ZendFormButtonTest
{

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->helper = new FormButton;
        CommonTestCase::setUp();
    }
    
    /**
     * {@inheritDoc}
     */
    public function validAttributes()
    {
        return [
            ['href', 'assertContains'],
        ];
    }
}
>>>>>>> Stashed changes
