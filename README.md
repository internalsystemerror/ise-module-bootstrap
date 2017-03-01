# Twitter Bootstrap module for Zend Framework 2+

## Introduction

This module intends to integrate Twitter Bootstrap with Zend Framework 2 and
offers general view helpers, navigation view helpers and form view helpers.

## Requirements

This module uses [AssetManager](https://github.com/RWOverdijk/AssetManager), and
by default, comes set up to use [YuiCompressor](https://github.com/yui/yuicompressor)
to compress assets.

## Installation

Installation of this module uses composer.
```sh
php composer.phar require ise/ise-module-bootstrap
```

Then add the following modules into your Zend Framework configuration.
  - AssetManager
  - Ise\Bootstrap

## Usage

#### Form View Helpers

The following form view helpers are registered by default, which override those
provided by Zend Framework, and can be used in their place. All elements will
have the appropriate bootstrap style classes added to them.
  - [Form](src/Form/View/Helper/Form.php)
  - [FormButton](src/Form/View/Helper/FormButton.php)
  - [FormCheckbox](src/Form/View/Helper/FormCheckbox.php)
  - [FormColor](src/Form/View/Helper/FormColor.php)
  - [FormDate](src/Form/View/Helper/FormDate.php)
  - [FormDateSelect](src/Form/View/Helper/FormDateSelect.php)
  - [FormDateTime](src/Form/View/Helper/FormDateTime.php)
  - [FormDateTimeLocal](src/Form/View/Helper/FormDateTimeLocal.php)
  - [FormDateTimeSelect](src/Form/View/Helper/FormDateTimeSelect.php)
  - [FormDescription](src/Form/View/Helper/FormDescription.php)
  - [FormElementErrors](src/Form/View/Helper/FormElementErrors.php)
  - [FormEmail](src/Form/View/Helper/FormEmail.php)
  - [FormFile](src/Form/View/Helper/FormFile.php)
  - [FormImage](src/Form/View/Helper/FormImage.php)
  - [FormInput](src/Form/View/Helper/FormInput.php)
  - [FormMonth](src/Form/View/Helper/FormMonth.php)
  - [FormMonthSelect](src/Form/View/Helper/FormMonthSelect.php)
  - [FormMultiCheckbox](src/Form/View/Helper/FormMultiCheckbox.php)
  - [FormNumber](src/Form/View/Helper/FormNumber.php)
  - [FormPassword](src/Form/View/Helper/FormPassword.php)
  - [FormRange](src/Form/View/Helper/FormRange.php)
  - [FormRow](src/Form/View/Helper/FormRow.php)
  - [FormSearch](src/Form/View/Helper/FormSearch.php)
  - [FormSelect](src/Form/View/Helper/FormSelect.php)
  - [FormTel](src/Form/View/Helper/FormTel.php)
  - [FormText](src/Form/View/Helper/FormText.php)
  - [FormTime](src/Form/View/Helper/FormTime.php)
  - [FormUrl](src/Form/View/Helper/FormUrl.php)
  - [FormWeek](src/Form/View/Helper/FormWeek.php)

An entire form can easily be rendered as follows:
```php

/**
 * Where $form implements Zend\Form\FormInterface
 */
echo $this->form($form);

```

#### View Helpers

The bootstrap CSS/JS and meta tags are added by usage of a DispatchListener. The
following view helpers are registered by default.
  - [Alert](src/View/Helper/Alert.php)
  - [Badge](src/View/Helper/Badge.php)
  - [FlashMessenger](src/View/Helper/FlashMessenger.php)
  - [Icon](src/View/Helper/Icon.php)
  - [Label](src/View/Helper/Label.php)
  - [Time](src/View/Helper/Time.php)

> Note: The Time plugin uses [jQuery Timeago](http://timeago.yarp.com/) to
> display time as "2 minutes ago" for instance.

#### Navigation View Helpers

The following navigation view helpers are registered by default.
  - [Navbar](src/View/Helper/Navigation/Navbar.php)

You can use the navbar helper as follows:
```php

/**
 * Where $container is a valid navigation container name, such as
 * 'default_navigation', if using the default ZF2 navigation factory.
 *
 * To have some of the links floated to the right (a login button for instance),
 * you can pass in the 'rightMenu' option to point to another navigation
 * container instance.
 */
echo $this->navigation($container)->navbar()->render(null, [
    'brand'     => [
        'label' => 'Your Brand Name Here',
        'route' => 'home',
        'icon'  => 'th-large', // Or any other icon name that would be prefixed glyphicon-*
    ],
    'inverse'   => true,
    'fixed'     => 'top',
    'rightMenu' => $anotherContainer,
]);

```

## Credits

Made by [Internalsystemerror Limited](http://www.internalsystemerror.com), and
released under the [BSD 3-Clause License](LICENSE)