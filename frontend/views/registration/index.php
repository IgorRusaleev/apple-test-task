<?php

/* @var $this yii\web\View */

/* @var $users User */

/* @var $model RegistrationForm */

use frontend\models\RegistrationForm;
use frontend\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<section class="registration__user">
    <h1>Регистрация аккаунта</h1>
    <div class="registration-wrapper">
        <?php
        $form = ActiveForm::begin(
            [
                'enableClientValidation' => true,
                'fieldConfig' => [
                    'template' => "</br>{label}</br>{input}</br>{hint}</br>{error}",
                    'inputOptions' => ['class' => 'input textarea input-wide'],
                    'errorOptions' => ['tag' => 'span', 'class' => 'input-error'],
                    'hintOptions' => ['tag' => 'span'],
                ],
                'options' => [
                    'class' => 'registration__user-form form-create',
                ]
            ]
        ); ?>
        <?= $form->field($model, 'email')
            ->textInput(
                [
                    'class' => 'input textarea',
                    'rows' => '1',
                    'placeholder' => 'login@mail.ru',
                ]
            )
            ->label('Электронная почта')
            ->hint('Введите валидный адрес электронной почты');

        ?>

        <?= $form->field(
            $model,
            'password',
            [
                'inputOptions' => [
                    'class' => 'input textarea',
                ],
            ]
        )->passwordInput()
            ->label('Пароль')
            ->hint('Длина пароля от 8 символов');
        ?>

        <?= Html::button('Создать аккаунт', ['class' => 'button button__registration', 'type' => 'submit']); ?>
        <?php
        $form = ActiveForm::end(); ?>
    </div>
</section>
