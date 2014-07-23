<?php

namespace ruxon\modules\App\controllers;

/**
 * Class IndexController
 * @package ruxon\modules\App\controllers
 */
class IndexController extends \FrontendController
{
    public function actionIndex($params = array())
    {
        return $this->view('Index');
    }

    public function actionAbout($params = array())
    {
        return $this->view('About');
    }
}