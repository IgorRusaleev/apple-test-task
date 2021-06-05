<?php

use frontend\assets\ActionsWidgetAsset;
use frontend\models\Apple;
use frontend\widgets\EstimatedTimeWidget;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\widgets\Pjax;

/**
 * @var ActiveDataProvider $dataProvider
 * @var Apple $apple
 */

ActionsWidgetAsset::register($this);
?>
<p>
    <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/apple/create']); ?>">
        Создать случайное количество яблок разного цвета
    </a>
</p>
<section>
    <div class="container-fluid">
        <?php Pjax::begin(['id' => 'apples-list']); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'class' => SerialColumn::class,
                ],
                [
                    'label' => 'Цвет яблока',
                    'attribute' => 'colour',
                ],
                [
                    'label' => 'Статус яблока',
                    'attribute' => 'statusTitle',
                ],
                [
                    'label' => 'Размер яблока',
                    'value' => function (Apple $apple) {
                        return number_format($apple->size / 100, 2, '.', ' ');
                    },
                ],
                [
                    'label' => 'Создано',
                    'format' => 'html',
                    'value' => function (Apple $apple) {
                        return sprintf(
                            "%s<br />%s",
                            Yii::$app->formatter->asDatetime($apple->dt_add, 'Y-MM-dd HH:kk:ss'),
                            EstimatedTimeWidget::widget(['timestamp' => $apple->dt_add])
                        );
                    },
                ],
                [
                    'label' => 'Упало',
                    'format' => 'html',
                    'value' => function (Apple $apple) {
                        return sprintf(
                            "%s<br />%s",
                            Yii::$app->formatter->asDatetime($apple->dt_fall, 'Y-MM-dd HH:kk:ss'),
                            $apple->dt_fall ?
                                EstimatedTimeWidget::widget(['timestamp' => $apple->dt_fall]) : 'яблоко не упало'
                        );
                    },
                ],
                [
                    'class' => \yii\grid\ActionColumn::class,
                    'template' => '{fall} {eat}',
                    'buttons' => [
                        'fall' => function ($url, Apple $model, $key) {
                            if ($model->status === Apple::STATUS_HANGING) {
                                return \yii\helpers\Html::button('Упасть', [
                                    'class' => 'btn btn-sm btn-success fall-btn',
                                    'data-id' => $model->id,
                                ]);
                            }

                            return null;
                        },
                        'eat' => function ($url, Apple $model, $key) {
                            if ($model->status === Apple::STATUS_FALL) {
                                return \yii\helpers\Html::button('Съесть', [
                                    'class' => 'btn btn-sm btn-warning eat-btn',
                                    'data-id' => $model->id,
                                ]);
                            }

                            return null;
                        },
                    ],
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</section>

<div class="modal fade" id="eat-modal" tabindex="-1" role="dialog" aria-labelledby="eatModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Съешь яблоко</h4>
            </div>
            <div class="modal-body">
                <p><input type="text" id="apple-eat-size" class="form-control" placeholder="Укажите размер яблока в %" /></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="confirm-eat-btn">Съесть</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
