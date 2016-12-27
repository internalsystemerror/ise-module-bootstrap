<?php

use Ise\Bootstrap\Form\View\Helper as FormHelper;
use Ise\Bootstrap\View\Helper;

return [
    'invokables' => [
        'form'               => FormHelper\Form::class,
        'formbutton'         => FormHelper\FormButton::class,
        'formcheckbox'       => FormHelper\FormCheckbox::class,
        'formcolor'          => FormHelper\FormColor::class,
        'formdate'           => FormHelper\FormDate::class,
        'formdateselect'     => FormHelper\FormDateSelect::class,
        'formdatetime'       => FormHelper\FormDateTime::class,
        'formdatetimelocal'  => FormHelper\FormDateTimeLocal::class,
        'formdatetimeselect' => FormHelper\FormDateTimeSelect::class,
        'formdescription'    => FormHelper\FormDescription::class,
        'formelementerrors'  => FormHelper\FormElementErrors::class,
        'formemail'          => FormHelper\FormEmail::class,
        'formfile'           => FormHelper\FormFile::class,
        'formimage'          => FormHelper\FormImage::class,
        'forminput'          => FormHelper\FormInput::class,
        'formmonth'          => FormHelper\FormMonth::class,
        'formmonthselect'    => FormHelper\FormMonthSelect::class,
        'formmulticheckbox'  => FormHelper\FormMultiCheckbox::class,
        'formnumber'         => FormHelper\FormNumber::class,
        'formpassword'       => FormHelper\FormPassword::class,
        'formrange'          => FormHelper\FormRange::class,
        'formrow'            => FormHelper\FormRow::class,
        'formsearch'         => FormHelper\FormSearch::class,
        'formselect'         => FormHelper\FormSelect::class,
        'formtel'            => FormHelper\FormTel::class,
        'formtext'           => FormHelper\FormText::class,
        'formtime'           => FormHelper\FormTime::class,
        'formurl'            => FormHelper\FormUrl::class,
        'formweek'           => FormHelper\FormWeek::class,
        'alert'              => Helper\Alert::class,
        'badge'              => Helper\Badge::class,
        'icon'               => Helper\Icon::class,
        'label'              => Helper\Label::class,
        'time'               => Helper\Time::class,
    ],
];
