<?php

namespace frontend\controllers;

use Yii;
use frontend\models\RegistrationForm;
use yii\web\Controller;
use yii\web\Response;

class RegistrationController extends Controller
{
    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $model = new RegistrationForm();
        $model->load(Yii::$app->request->post());

        if ($model->validate() && ($user = $model->createUser())) {
            Yii::$app->user->login($user);

            return $this->goHome();
        }

        return $this->render('index', ['model' => $model]);
    }
}