<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->context->layout='layout2';
$this->title = '粉丝列表';
$this->params['breadcrumbs'][] = $this->title;
$userModel = new \app\models\User;
?>

<div id="stage">
    <ul class="list-group">
        <?php foreach ($list as $item): ?>
            <?php
                $user = $userModel->findeByUid($item->uid);
                $hide = \app\models\Fellow::isFellow(Yii::$app->session['uid'],$item->uid);

            ?>

            <li class="list-group-item">
                <a href="<?=\yii\helpers\Url::to(['member/card','uid'=>$item->uid])?>">
                    <div class="row">
                        <div class="col-2">
                            <img src="../uploads/<?=$user->avatar?>" alt="userAvator" class="rounded-circle">
                        </div>
                        <div class="col-10">
                            <span><?=$user->name?></span>
                            <?=Html::hiddenInput('uid',Yii::$app->session['uid'],['id'=>'h_'.$user->uid])?>
                            <?=Html::button('关注',[
                                'id' => $user->uid,
                                'style' => $hide?'display:none':'',
                            ]) ?>
                        </div>
                    </div>
                </a>
            </li>

        <?php  endforeach; ?>
    </ul>
</div>
<?php
$url = \yii\helpers\Url::to(['member/fellow']);
$js = <<<JS
    $("button").click(function() {
        var f_uid = $(this).attr('id');
        var uid = $("#h_"+f_uid).val();
         $(this).hide();
        $.post("$url",{
            uid: uid,
            f_uid: f_uid    
        },function() {
            
        })
    })



JS;
$this->registerJs($js);


?>



