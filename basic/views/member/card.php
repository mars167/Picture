<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->context->layout = 'layout2';
$this->title = '详情';
$this->params['breadcrumbs'][] = $this->title;
$uid = Yii::$app->session['uid'];
$likeModel = new \app\models\Likes;
$photoes = $photo->showByUid($uid);
?>
    <div id="stage">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <img class="card-img-top" src="../uploads/<?=$user->avatar?>" alt="Avator" id="avator">
                    </div>
                    <div class="col-7">
                        <div class="card-body">
                            <h5 class="card-title" id="username"><?=$user->name ?></h5>
                            <p class="card-text" id="email"><?=$user->email ?></p>
                            <p><?=$user->profile?></p>
                            <span><?=$user->sex==1?'男':'女' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php foreach ($photoes as $item): ?>
    <?php
        $islike = $likeModel->isLike($item->id,$uid);
    ?>
    <div id="stage">
        <div class="card">
            <div class="card-body">
                <p class="card-text mt-2" id="text"><?=$item->title?></p>
            </div>
            <img class="card-img-top" src="../uploads/photoes/<?=$item->photo?>" alt="Card image cap">
            <div class="card-body">
                <hr>
                <div class="row">
                    <div class="col-7">
                        <?=Html::Button('',['id'=>$item->id,"$islike"=>'','class'=>'like oi oi-thumb-up']) ?>
                        <span class="likeAmt" id="id_<?=$item->id?>"  ><?=$item->likes == null?0:$item->likes?></span>
                    </div>
                    <div class="col-5">
                        <span class="" id="date"><?=$item->update_time?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php
$url = \yii\helpers\Url::to(["picture/like"]);
$js = <<<JS
    $("button").click(function() {
       var id = $(this).attr("id");
       var like = $("#id_"+id).text();
       like++;
       $(this).attr("disabled","true");
       $.post("$url",{
           id : id,
           uid : $uid,
           like : like
       },function(data,textStatus) {
           $("#id_"+id).html(like);
       })
    })

JS;

$this->registerJs($js);
?>