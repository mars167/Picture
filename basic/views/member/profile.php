<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->context->layout = 'layout2';
$this->title = '个人中心';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="stage">
    <div class="card">
        <div class="row">
            <div class="col-5">
                <img class="card-img-top" src="../uploads/<?=$user->avatar?>" alt="Avator" id="avator">
            </div>
            <div class="col-7">
                <div class="card-body">
                    <h5 class="card-title" id="username"><?=$user->name ?></h5>
                    <p class="card-text" id="email"><?=$user->email ?></p>
                    <span><?=$user->sex==1?'男':'女' ?></span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-9">
                    <p class="card-text" id="bio"><?=$user->profile ?></p>
                </div>
                <div class="col-3">
                    <a  href="<?=\yii\helpers\Url::to(['member/update'])?>">修改</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div class="row">
            <div class="col-6">
                <div class="card-body">
                    <a href="<?=Url::to(['member/fellowlist'])?>">关注：<span><?=$fellow?></span></a>
                </div>
            </div>
            <div class="col-6">
                <div class="card-body">
                    <a href="<?=Url::to(['member/fanslist'])?>">粉丝：<span><?=$fans?></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="row">
            <div class="col-12">
                <a href="<?=Url::to(['member/logout'])?>" class="btn btn-secondary btn-block">退出登录</a>
            </div>
        </div>
    </div>
</div>