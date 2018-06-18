<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

use Ise\Bootstrap\Form\View\Helper as FormHelper;
use Ise\Bootstrap\View\Helper;
use Zend\Form\View\Helper as ZendFormHelper;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\View\Helper as ZendHelper;

return [
    'aliases'   => [
        /**
         * v2 overrides
         */
        'form'                                   => FormHelper\Form::class,
        'formbutton'                             => FormHelper\FormButton::class,
        'formcheckbox'                           => FormHelper\FormCheckbox::class,
        'formcolor'                              => FormHelper\FormColor::class,
        'formdate'                               => FormHelper\FormDate::class,
        'formdateselect'                         => FormHelper\FormDateSelect::class,
        'formdatetime'                           => FormHelper\FormDateTime::class,
        'formdatetimelocal'                      => FormHelper\FormDateTimeLocal::class,
        'formdatetimeselect'                     => FormHelper\FormDateTimeSelect::class,
        'formdescription'                        => FormHelper\FormDescription::class,
        'formelementerrors'                      => FormHelper\FormElementErrors::class,
        'formemail'                              => FormHelper\FormEmail::class,
        'formfile'                               => FormHelper\FormFile::class,
        'formimage'                              => FormHelper\FormImage::class,
        'forminput'                              => FormHelper\FormInput::class,
        'formmonth'                              => FormHelper\FormMonth::class,
        'formmonthselect'                        => FormHelper\FormMonthSelect::class,
        'formmulticheckbox'                      => FormHelper\FormMultiCheckbox::class,
        'formnumber'                             => FormHelper\FormNumber::class,
        'formpassword'                           => FormHelper\FormPassword::class,
        'formrange'                              => FormHelper\FormRange::class,
        'formrow'                                => FormHelper\FormRow::class,
        'formsearch'                             => FormHelper\FormSearch::class,
        'formselect'                             => FormHelper\FormSelect::class,
        'formtel'                                => FormHelper\FormTel::class,
        'formtext'                               => FormHelper\FormText::class,
        'formtime'                               => FormHelper\FormTime::class,
        'formurl'                                => FormHelper\FormUrl::class,
        'formweek'                               => FormHelper\FormWeek::class,
        /**
         * Zend\Form\View\Helper overrides
         */
        ZendFormHelper\Form::class               => FormHelper\Form::class,
        ZendFormHelper\FormButton::class         => FormHelper\FormButton::class,
        ZendFormHelper\FormCheckbox::class       => FormHelper\FormCheckbox::class,
        ZendFormHelper\FormColor::class          => FormHelper\FormColor::class,
        ZendFormHelper\FormDate::class           => FormHelper\FormDate::class,
        ZendFormHelper\FormDateSelect::class     => FormHelper\FormDateSelect::class,
        ZendFormHelper\FormDateTime::class       => FormHelper\FormDateTime::class,
        ZendFormHelper\FormDateTimeLocal::class  => FormHelper\FormDateTimeLocal::class,
        ZendFormHelper\FormDateTimeSelect::class => FormHelper\FormDateTimeSelect::class,
        ZendFormHelper\FormDescription::class    => FormHelper\FormDescription::class,
        ZendFormHelper\FormElementErrors::class  => FormHelper\FormElementErrors::class,
        ZendFormHelper\FormEmail::class          => FormHelper\FormEmail::class,
        ZendFormHelper\FormFile::class           => FormHelper\FormFile::class,
        ZendFormHelper\FormImage::class          => FormHelper\FormImage::class,
        ZendFormHelper\FormInput::class          => FormHelper\FormInput::class,
        ZendFormHelper\FormMonth::class          => FormHelper\FormMonth::class,
        ZendFormHelper\FormMonthSelect::class    => FormHelper\FormMonthSelect::class,
        ZendFormHelper\FormMultiCheckbox::class  => FormHelper\FormMultiCheckbox::class,
        ZendFormHelper\FormNumber::class         => FormHelper\FormNumber::class,
        ZendFormHelper\FormPassword::class       => FormHelper\FormPassword::class,
        ZendFormHelper\FormRange::class          => FormHelper\FormRange::class,
        ZendFormHelper\FormRow::class            => FormHelper\FormRow::class,
        ZendFormHelper\FormSearch::class         => FormHelper\FormSearch::class,
        ZendFormHelper\FormSelect::class         => FormHelper\FormSelect::class,
        ZendFormHelper\FormTel::class            => FormHelper\FormTel::class,
        ZendFormHelper\FormText::class           => FormHelper\FormText::class,
        ZendFormHelper\FormTime::class           => FormHelper\FormTime::class,
        ZendFormHelper\FormUrl::class            => FormHelper\FormUrl::class,
        ZendFormHelper\FormWeek::class           => FormHelper\FormWeek::class,
        /**
         * Zend\View\Helper overrides
         */
        ZendHelper\FlashMessenger::class         => Helper\FlashMessenger::class,
        /**
         * Custom helpers
         */
        'alert'                                  => Helper\Alert::class,
        'Alert'                                  => Helper\Alert::class,
        'badge'                                  => Helper\Badge::class,
        'Badge'                                  => Helper\Badge::class,
        'icon'                                   => Helper\Icon::class,
        'Icon'                                   => Helper\Icon::class,
        'label'                                  => Helper\Label::class,
        'Label'                                  => Helper\Label::class,
        'time'                                   => Helper\Time::class,
        'Time'                                   => Helper\Time::class,
    ],
    'factories' => [
        FormHelper\Form::class               => InvokableFactory::class,
        FormHelper\FormButton::class         => InvokableFactory::class,
        FormHelper\FormCheckbox::class       => InvokableFactory::class,
        FormHelper\FormColor::class          => InvokableFactory::class,
        FormHelper\FormDate::class           => InvokableFactory::class,
        FormHelper\FormDateSelect::class     => InvokableFactory::class,
        FormHelper\FormDateTime::class       => InvokableFactory::class,
        FormHelper\FormDateTimeLocal::class  => InvokableFactory::class,
        FormHelper\FormDateTimeSelect::class => InvokableFactory::class,
        FormHelper\FormDescription::class    => InvokableFactory::class,
        FormHelper\FormElementErrors::class  => InvokableFactory::class,
        FormHelper\FormEmail::class          => InvokableFactory::class,
        FormHelper\FormFile::class           => InvokableFactory::class,
        FormHelper\FormImage::class          => InvokableFactory::class,
        FormHelper\FormInput::class          => InvokableFactory::class,
        FormHelper\FormMonth::class          => InvokableFactory::class,
        FormHelper\FormMonthSelect::class    => InvokableFactory::class,
        FormHelper\FormMultiCheckbox::class  => InvokableFactory::class,
        FormHelper\FormNumber::class         => InvokableFactory::class,
        FormHelper\FormPassword::class       => InvokableFactory::class,
        FormHelper\FormRange::class          => InvokableFactory::class,
        FormHelper\FormRow::class            => InvokableFactory::class,
        FormHelper\FormSearch::class         => InvokableFactory::class,
        FormHelper\FormSelect::class         => InvokableFactory::class,
        FormHelper\FormTel::class            => InvokableFactory::class,
        FormHelper\FormText::class           => InvokableFactory::class,
        FormHelper\FormTime::class           => InvokableFactory::class,
        FormHelper\FormUrl::class            => InvokableFactory::class,
        FormHelper\FormWeek::class           => InvokableFactory::class,
        Helper\Alert::class                  => InvokableFactory::class,
        Helper\Badge::class                  => InvokableFactory::class,
        Helper\FlashMessenger::class         => InvokableFactory::class,
        Helper\Icon::class                   => InvokableFactory::class,
        Helper\Label::class                  => InvokableFactory::class,
        Helper\Time::class                   => InvokableFactory::class,
    ],
];
