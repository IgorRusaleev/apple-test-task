<?php

namespace frontend\assets;

class ActionsWidgetAsset extends \yii\web\AssetBundle
{
    public $js = ['js/actions-list.js'];

    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
