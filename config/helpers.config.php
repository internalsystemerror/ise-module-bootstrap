<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Bootstrap;

use Zend\Form\View\Helper;
use Zend\Mvc\Plugin\FlashMessenger\View\Helper\FlashMessenger;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
        /**
         * v2 overrides
         */
        'form'                           => Form\View\Helper\Form::class,
        'formbutton'                     => Form\View\Helper\FormButton::class,
        'formcheckbox'                   => Form\View\Helper\FormCheckbox::class,
        'formcolor'                      => Form\View\Helper\FormColor::class,
        'formdate'                       => Form\View\Helper\FormDate::class,
        'formdateselect'                 => Form\View\Helper\FormDateSelect::class,
        'formdatetime'                   => Form\View\Helper\FormDateTime::class,
        'formdatetimelocal'              => Form\View\Helper\FormDateTimeLocal::class,
        'formdatetimeselect'             => Form\View\Helper\FormDateTimeSelect::class,
        'formdescription'                => Form\View\Helper\FormDescription::class,
        'formelementerrors'              => Form\View\Helper\FormElementErrors::class,
        'formemail'                      => Form\View\Helper\FormEmail::class,
        'formfile'                       => Form\View\Helper\FormFile::class,
        'formimage'                      => Form\View\Helper\FormImage::class,
        'forminput'                      => Form\View\Helper\FormInput::class,
        'formmonth'                      => Form\View\Helper\FormMonth::class,
        'formmonthselect'                => Form\View\Helper\FormMonthSelect::class,
        'formmulticheckbox'              => Form\View\Helper\FormMultiCheckbox::class,
        'formnumber'                     => Form\View\Helper\FormNumber::class,
        'formpassword'                   => Form\View\Helper\FormPassword::class,
        'formrange'                      => Form\View\Helper\FormRange::class,
        'formrow'                        => Form\View\Helper\FormRow::class,
        'formsearch'                     => Form\View\Helper\FormSearch::class,
        'formselect'                     => Form\View\Helper\FormSelect::class,
        'formtel'                        => Form\View\Helper\FormTel::class,
        'formtext'                       => Form\View\Helper\FormText::class,
        'formtime'                       => Form\View\Helper\FormTime::class,
        'formurl'                        => Form\View\Helper\FormUrl::class,
        'formweek'                       => Form\View\Helper\FormWeek::class,
        /**
         * Zend\Form\View\Helper overrides
         */
        Helper\Form::class               => Form\View\Helper\Form::class,
        Helper\FormButton::class         => Form\View\Helper\FormButton::class,
        Helper\FormCheckbox::class       => Form\View\Helper\FormCheckbox::class,
        Helper\FormColor::class          => Form\View\Helper\FormColor::class,
        Helper\FormDate::class           => Form\View\Helper\FormDate::class,
        Helper\FormDateSelect::class     => Form\View\Helper\FormDateSelect::class,
        Helper\FormDateTime::class       => Form\View\Helper\FormDateTime::class,
        Helper\FormDateTimeLocal::class  => Form\View\Helper\FormDateTimeLocal::class,
        Helper\FormDateTimeSelect::class => Form\View\Helper\FormDateTimeSelect::class,
        Helper\FormElementErrors::class  => Form\View\Helper\FormElementErrors::class,
        Helper\FormEmail::class          => Form\View\Helper\FormEmail::class,
        Helper\FormFile::class           => Form\View\Helper\FormFile::class,
        Helper\FormImage::class          => Form\View\Helper\FormImage::class,
        Helper\FormInput::class          => Form\View\Helper\FormInput::class,
        Helper\FormMonth::class          => Form\View\Helper\FormMonth::class,
        Helper\FormMonthSelect::class    => Form\View\Helper\FormMonthSelect::class,
        Helper\FormMultiCheckbox::class  => Form\View\Helper\FormMultiCheckbox::class,
        Helper\FormNumber::class         => Form\View\Helper\FormNumber::class,
        Helper\FormPassword::class       => Form\View\Helper\FormPassword::class,
        Helper\FormRange::class          => Form\View\Helper\FormRange::class,
        Helper\FormRow::class            => Form\View\Helper\FormRow::class,
        Helper\FormSearch::class         => Form\View\Helper\FormSearch::class,
        Helper\FormSelect::class         => Form\View\Helper\FormSelect::class,
        Helper\FormTel::class            => Form\View\Helper\FormTel::class,
        Helper\FormText::class           => Form\View\Helper\FormText::class,
        Helper\FormTime::class           => Form\View\Helper\FormTime::class,
        Helper\FormUrl::class            => Form\View\Helper\FormUrl::class,
        Helper\FormWeek::class           => Form\View\Helper\FormWeek::class,
        /**
         * Zend\View\Helper overrides
         */
        FlashMessenger::class            => View\Helper\FlashMessenger::class,
        /**
         * Custom helpers
         */
        'alert'                          => View\Helper\Alert::class,
        'Alert'                          => View\Helper\Alert::class,
        'badge'                          => View\Helper\Badge::class,
        'Badge'                          => View\Helper\Badge::class,
        'icon'                           => View\Helper\Icon::class,
        'Icon'                           => View\Helper\Icon::class,
        'label'                          => View\Helper\Label::class,
        'Label'                          => View\Helper\Label::class,
        'time'                           => View\Helper\Time::class,
        'Time'                           => View\Helper\Time::class,
    ],
    'factories' => [
        Form\View\Helper\Form::class               => InvokableFactory::class,
        Form\View\Helper\FormButton::class         => InvokableFactory::class,
        Form\View\Helper\FormCheckbox::class       => InvokableFactory::class,
        Form\View\Helper\FormColor::class          => InvokableFactory::class,
        Form\View\Helper\FormDate::class           => InvokableFactory::class,
        Form\View\Helper\FormDateSelect::class     => InvokableFactory::class,
        Form\View\Helper\FormDateTime::class       => InvokableFactory::class,
        Form\View\Helper\FormDateTimeLocal::class  => InvokableFactory::class,
        Form\View\Helper\FormDateTimeSelect::class => InvokableFactory::class,
        Form\View\Helper\FormDescription::class    => InvokableFactory::class,
        Form\View\Helper\FormElementErrors::class  => InvokableFactory::class,
        Form\View\Helper\FormEmail::class          => InvokableFactory::class,
        Form\View\Helper\FormFile::class           => InvokableFactory::class,
        Form\View\Helper\FormImage::class          => InvokableFactory::class,
        Form\View\Helper\FormInput::class          => InvokableFactory::class,
        Form\View\Helper\FormMonth::class          => InvokableFactory::class,
        Form\View\Helper\FormMonthSelect::class    => InvokableFactory::class,
        Form\View\Helper\FormMultiCheckbox::class  => InvokableFactory::class,
        Form\View\Helper\FormNumber::class         => InvokableFactory::class,
        Form\View\Helper\FormPassword::class       => InvokableFactory::class,
        Form\View\Helper\FormRange::class          => InvokableFactory::class,
        Form\View\Helper\FormRow::class            => InvokableFactory::class,
        Form\View\Helper\FormSearch::class         => InvokableFactory::class,
        Form\View\Helper\FormSelect::class         => InvokableFactory::class,
        Form\View\Helper\FormTel::class            => InvokableFactory::class,
        Form\View\Helper\FormText::class           => InvokableFactory::class,
        Form\View\Helper\FormTime::class           => InvokableFactory::class,
        Form\View\Helper\FormUrl::class            => InvokableFactory::class,
        Form\View\Helper\FormWeek::class           => InvokableFactory::class,
        View\Helper\Alert::class                   => InvokableFactory::class,
        View\Helper\Badge::class                   => InvokableFactory::class,
        View\Helper\FlashMessenger::class          => InvokableFactory::class,
        View\Helper\Icon::class                    => InvokableFactory::class,
        View\Helper\Label::class                   => InvokableFactory::class,
        View\Helper\Time::class                    => InvokableFactory::class,
    ],
];
