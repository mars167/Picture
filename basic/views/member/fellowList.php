<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->context->layout = 'layout2';
$this->title = '关注列表';
$this->params['breadcrumbs'][] = $this->title;
$userModel = new \app\models\User;
$uid = Yii::$app->session['uid'];
?>

<div id="stage">
    <ul class="list-group">
        <?php foreach ($list as $item): ?>
        <?php
            $user = $userModel->findeByUid($item->f_uid);
            $hide = !\app\models\Fellow::isFellow($item->f_uid,Yii::$app->session['uid']);

            ?>

            <li class="list-group-item">
                <a href="<?=\yii\helpers\Url::to(['member/card','uid'=>$item->f_uid])?>">
                    <div class="row">
                        <div class="col-2">
                            <img src="../uploads/<?=$user->avatar?>" alt="userAvator" class="rounded-circle">
                        </div>
                        <div class="col-10">
                            <span><?=$user->name?></span>
                            <?=Html::hiddenInput('uid',$uid,['id'=>'f_'.$item->f_uid])?>
                            <?=Html::button('取消关注',[
                                'id' => $item->f_uid,
                                'style' => $hide?'display:none':'',
                                'class' => 'btn btn-primary'
                            ]) ?>
                        </div>
                    </div>
                </a>
            </li>

        <?php  endforeach; ?>
    </ul>
</div>
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