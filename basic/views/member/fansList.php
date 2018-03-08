<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '粉丝列表';
$this->params['breadcrumbs'][] = $this->title;
$userModel = new \app\models\User;
?>


<?php foreach ($list as $item): ?>
    <?php
        $user = $userModel->findeByUid($item->uid);
        $hide = \app\models\Fellow::isFellow(Yii::$app->session['uid'],$item->uid);

    ?>
    <div>
        <img width="50px" style="border-radius: 50% !important; margin-right:5px;" src="../uploads/<?=$user->avatar?>">
        <span><?=$user->name?></span>
        <?=Html::hiddenInput('uid',Yii::$app->session['uid'],['id'=>'h_'.$user->uid])?>
        <?=Html::button('关注',[
                'id' => $user->uid,
                'style' => $hide?'display:none':'',
        ]) ?>
    </div>
    <hr>

<?php  endforeach; ?>
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
