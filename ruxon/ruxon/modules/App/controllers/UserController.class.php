<?php

namespace ruxon\modules\App\controllers;
use ruxon\modules\App\models\LoginFormObject;

/**
 * Class UserController
 * @package ruxon\modules\App\controllers
 */
class UserController extends \FrontendController
{
    public function actionIndex($params = array())
    {
        return $this->view('Index');
    }

    public function actionLogin($params = array())
    {
        $errors = array();
        $user = new LoginFormObject();

        if(!empty($_POST)) {
            $user->import($_POST);

            if ($user->validate())
            {
                if (\Toolkit::i()->auth->login($_POST['Login'], $_POST['Password'], $_POST['RememberMe'])) {
                    if (isset($_GET['redirect'])) {
                        $this->redirect($_GET['redirect']);
                    } else {
                        header("Location: /");
                    }

                    Core::app()->hardEnd();
                } else {
                    $errors[] = $this->t('Basic', 'Wrong login or password');
                }


            } else {
                $errors = $user->getErrors();
            }
        }

        return $this->view('Login', array(
            'Model' => $user,
            'Errors' => $errors
        ));
    }

    public function actionLogout($params = array())
    {
        \Toolkit::i()->auth->logout();

        header("Location: /");
        Core::app()->hardEnd();
    }
}