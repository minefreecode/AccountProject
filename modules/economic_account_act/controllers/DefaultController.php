<?php

namespace app\modules\economic_account_act\controllers;

use yii\web\Controller;

/**
 * Default controller for the `economic_account_act` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
