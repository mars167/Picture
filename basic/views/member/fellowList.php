<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '关注列表';
$this->params['breadcrumbs'][] = $this->title;
$userModel = new \app\models\User;
$uid = Yii::$app->session['uid'];
?>
<?php foreach ($list as $item): ?>
    <?php $user = $userModel->findeByUid($item->f_uid) ?>
    <div id="d_<?=$item->f_uid?>">
        <img width="50px" style="border-radius: 50% !important; margin-right:5px;" src="../uploads/<?=$user->avatar?>">
        <span><?=$user->name?></span>
        <?=Html::hiddenInput('uid',$uid,['id'=>'f_'.$item->f_uid])?>
        <?=Html::button('取消关注',['id'=>$item->f_uid])?>
    </div>
    <hr>

<?php  endforeach; ?>
<?php
$url = \yii\helpers\Url::to(['member/delete']);
$js= <<<JS
    $("button").click(function() {
        var f_uid = $(this).attr("id");
        var uid = $("#f_"+f_uid).val();
        $.post("$url",{
            uid: uid,
            f_uid: f_uid
        },function() {
          $("#d_"+f_uid).hide();
        })
    })


JS;
$this->registerJs($js);


?>