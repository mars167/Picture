<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Picture',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => '登录', 'url' => ['/member/login']],
            ['label' => '注册', 'url' => ['/member/signup']],
            ['label' => '个人中心', 'url' => ['/member/profile']],
            ['label' => '主页（最新）', 'url' => ['/picture/index']],
            ['label' => '主页（热门）', 'url' => ['/picture/hotphotoes']],
            ['label' => '主页（我的）', 'url' => ['/picture/myphotoes']],
            ['label' => '主页（关注）', 'url' => ['/picture/fellowphotoes']],
            ['label' => '照片上传', 'url' => ['/picture/update']],
            !isset(Yii::$app->session['islogin']) ? (
                ['label' => 'Login', 'url' => ['/member/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/member/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->session['name'] . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
