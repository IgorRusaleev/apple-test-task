<?php

namespace console\controllers;

use frontend\models\Apple;
use yii\console\Controller;
use yii\db\Expression;

/**
 * Class AppleController
 * @package console\controllers
 */
class AppleController extends Controller
{
    /**
     * скрипт гниения яблок
     *
     * @return int
     */
    public function actionRotten(): int
    {
        Apple::updateAll(
            ['status' => Apple::STATUS_ROTTEN],
            'status = :fall AND dt_fall <= NOW() - INTERVAL 5 HOUR',
            ['fall' => Apple::STATUS_FALL]
        );

        return 0;
    }
}
