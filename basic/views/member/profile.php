<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = '个人中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>用户名：<?=$user->name ?> </p>
    <p>性别：<?=$user->sex==1?'男':'女' ?></p>
    <p>个人简介：<?=$user->profile ?></p>
    <p>电子邮价：<?=$user->email ?></p>
    <p>注册时间：<?=$user->regist_time ?></p>
    <p>登录时间：<?=$user->login_time ?></p>
</div>
