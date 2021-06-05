<?php
/* @var $model UserLoginForm */

/* @var $this View */

/* @var $content string */

use frontend\models\UserLoginForm;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
    $this->head() ?>
</head>
<body>
<?php
$this->beginBody() ?>

<div class="table-layout">
    <header class="page-header">
        <div class="main-container page-header__container container">
            <div class="account__pop-up">

                <div class="header__account--index">
                    <?php
                    if (Yii::$app->user->isGuest): ?>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/site/login']); ?>">
                            Вход
                        </a>
                        или
                        <a href="<?= Yii::$app->urlManager->createUrl(['/registration/index']); ?>">
                            Регистрация
                        </a>
                    <?php
                    endif; ?>

                    <?php
                    if (!Yii::$app->user->isGuest): ?>

                        <a href="<?= Yii::$app->urlManager->createUrl(['/site/logout']); ?>">
                            Выход
                        </a>

                    <?php
                    endif; ?>
                </div>

            </div>
        </div>
    </header>
    <main class="page-main">
        <div class="main-container page-container container">
            <?= $content; ?>
        </div>
    </main>
    <footer class="page-footer">
        <div class="main-container page-footer__container">
            <div class="page-footer__links">
                <ul class="links__list">
                </ul>
            </div>
        </div>
    </footer>
</div>


<?php
$this->endBody() ?>
</body>
</html>
<?php
$this->endPage() ?>
