<?php

namespace frontend\models;

use yii\data\ActiveDataProvider;

/**
 * Class AppleSearch
 * @package frontend\models
 */
class AppleSearch extends Apple
{
    /**
     * @return ActiveDataProvider
     */
    public function getDataProvider()
    {
        return new ActiveDataProvider([
            'query' => Apple::find()->where(['>', 'size', 0]),
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);
    }
}
