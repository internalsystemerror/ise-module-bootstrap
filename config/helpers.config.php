<?php

namespace IseBootstrap;

use IseBootstrap\Form\View\Helper\Form;
use IseBootstrap\Form\View\Helper\FormButton;
use IseBootstrap\Form\View\Helper\FormCheckbox;
use IseBootstrap\Form\View\Helper\FormColor;
use IseBootstrap\Form\View\Helper\FormDate;
use IseBootstrap\Form\View\Helper\FormDateSelect;
use IseBootstrap\Form\View\Helper\FormDateTime;
use IseBootstrap\Form\View\Helper\FormDateTimeLocal;
use IseBootstrap\Form\View\Helper\FormDateTimeSelect;
use IseBootstrap\Form\View\Helper\FormDescription;
use IseBootstrap\Form\View\Helper\FormElementErrors;
use IseBootstrap\Form\View\Helper\FormEmail;
use IseBootstrap\Form\View\Helper\FormFile;
use IseBootstrap\Form\View\Helper\FormImage;
use IseBootstrap\Form\View\Helper\FormInput;
use IseBootstrap\Form\View\Helper\FormMonth;
use IseBootstrap\Form\View\Helper\FormMonthSelect;
use IseBootstrap\Form\View\Helper\FormMultiCheckbox;
use IseBootstrap\Form\View\Helper\FormNumber;
use IseBootstrap\Form\View\Helper\FormPassword;
use IseBootstrap\Form\View\Helper\FormRange;
use IseBootstrap\Form\View\Helper\FormRow;
use IseBootstrap\Form\View\Helper\FormSearch;
use IseBootstrap\Form\View\Helper\FormSelect;
use IseBootstrap\Form\View\Helper\FormTel;
use IseBootstrap\Form\View\Helper\FormText;
use IseBootstrap\Form\View\Helper\FormTime;
use IseBootstrap\Form\View\Helper\FormUrl;
use IseBootstrap\Form\View\Helper\FormWeek;
use IseBootstrap\View\Helper\Alert;
use IseBootstrap\View\Helper\Badge;
use IseBootstrap\View\Helper\Icon;
use IseBootstrap\View\Helper\Label;
use IseBootstrap\View\Helper\Time;

return [
    'invokables' => [
        'form'               => Form::class,
        'formbutton'         => FormButton::class,
        'formcheckbox'       => FormCheckbox::class,
        'formcolor'          => FormColor::class,
        'formdate'           => FormDate::class,
        'formdateselect'     => FormDateSelect::class,
        'formdatetime'       => FormDateTime::class,
        'formdatetimelocal'  => FormDateTimeLocal::class,
        'formdatetimeselect' => FormDateTimeSelect::class,
        'formdescription'    => FormDescription::class,
        'formelementerrors'  => FormElementErrors::class,
        'formemail'          => FormEmail::class,
        'formfile'           => FormFile::class,
        'formimage'          => FormImage::class,
        'forminput'          => FormInput::class,
        'formmonth'          => FormMonth::class,
        'formmonthselect'    => FormMonthSelect::class,
        'formmulticheckbox'  => FormMultiCheckbox::class,
        'formnumber'         => FormNumber::class,
        'formpassword'       => FormPassword::class,
        'formrange'          => FormRange::class,
        'formrow'            => FormRow::class,
        'formsearch'         => FormSearch::class,
        'formselect'         => FormSelect::class,
        'formtel'            => FormTel::class,
        'formtext'           => FormText::class,
        'formtime'           => FormTime::class,
        'formurl'            => FormUrl::class,
        'formweek'           => FormWeek::class,
        'alert'              => Alert::class,
        'badge'              => Badge::class,
        'icon'               => Icon::class,
        'label'              => Label::class,
        'time'               => Time::class,
    ],
];
