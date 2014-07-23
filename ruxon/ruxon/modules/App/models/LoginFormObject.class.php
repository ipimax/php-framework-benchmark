<?php

namespace ruxon\modules\App\models;

class LoginFormObject extends \FormObject
{
    protected $sModuleAlias = 'App';

    public function fields()
    {
        return array(
            'Login' => array(
                'Type'     => 'String',
                'Title'    => $this->t('LoginForm', 'Login'),
                'Validation' => array(
                    'Required'  => true
                )
            ),

            'Password' => array(
                'Type'     => 'String',
                'Title'    => $this->t('LoginForm', 'Password'),
                'Validation' => array(
                    'Required'  => true
                )
            ),

            'RememberMe' => array(
                'Type'     => 'Boolean',
                'Title'    => $this->t('LoginForm', 'RememberMe'),
            ),
        );
    }
}