<?php

namespace ruxon\modules\Ruxon\components\Form\classes;

\Loader::import('Components.Ruxon.FormView');

class FormComponent extends \ruxon\modules\Ruxon\components\FormView\classes\FormViewComponent
{
    protected $sModuleAlias = 'Ruxon';
    protected $sComponentAlias = 'Form';
}