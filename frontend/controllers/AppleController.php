<?php

namespace frontend\controllers;

use Exception;
use frontend\models\Apple;
use frontend\models\AppleSearch;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class AppleController
 * @package frontend\controllers
 */
class AppleController extends Controller
{
    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new AppleSearch();

        return $this->render(
            'grid',
            ['dataProvider' => $searchModel->getDataProvider()]
        );
    }

    /**
     * @return Response
     */
    public function actionCreate()
    {
        Apple::create();

        return $this->redirect('/apple');
    }

    /**
     * действие: падение яблока
     *
     * @param int $id ID ялока
     * @throws Exception
     */
    public function actionFall(int $id): void
    {
        $apple = Apple::findOne($id);
        $apple->fallToGround();
    }

    /**
     * действие: съесть яблоко
     *
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionEat(): void
    {
        $id = (int)\Yii::$app->request->post('id');
        $size = (int)\Yii::$app->request->post('size');

        if (!$id) {
            throw new BadRequestHttpException('Данные отсутствуют');
        }

        $apple = Apple::findOne($id);
        if (!$apple) {
            throw new NotFoundHttpException('Яблоко не найдено');
        }
        $apple->eat($size);
    }
}