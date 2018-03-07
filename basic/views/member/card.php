<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '详情';
$this->params['breadcrumbs'][] = $this->title;
$uid = Yii::$app->session['uid'];
$likeModel = new \app\models\Likes;
$photoes = $photo->showByUid($uid);
?>
<div>
    <img width="50px" style="border-radius: 50% !important; margin-right:5px;" src="../uploads/<?=$user->avatar?>">
    <span><?=$user->name?></span>
    <p><?=$user->profile?></p>
</div>
<hr>
<hr>
<?php foreach ($photoes as $item): ?>
    <?php
        $islike = $likeModel->isLike($item->id,$uid);
    ?>
    <div class="row">

        <div>
            <img width="300px" src="../uploads/photoes/<?=$item->photo?>">
        </div>
        <p>likes:<span id="id_<?=$item->id?>"><?=$item->likes == null?0:$item->likes?></span>
            <?=Html::Button('赞',['id'=>$item->id,'style'=>$islike?'display:none':'']) ?>
        </p>
        <span><?=$item->update_time?></span>
        <hr>
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