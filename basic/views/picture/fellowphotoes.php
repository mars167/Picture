<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Fellow;


$this->title = 'Picture（关注）';
$this->params['breadcrumbs'][] = $this->title;
$uid = Yii::$app->session['uid'];
$userModel = new \app\models\User;
$likeModel = new \app\models\Likes;
$fellow = new Fellow();
$fellows = $fellow->findFellowByUId($uid);
?>

<?php foreach ($model->showByFellow($uid) as $item): ?>
    <?php
        $user = $userModel->findeByUid($item->uid);
        $islike = $likeModel->isLike($item->id,$uid);
    ?>
    <div class="row">
        <div>
            <img width="25px" style="border-radius: 50% !important; margin-right:5px;" src="../uploads/<?=$user->avatar?>">
            <span><?=$user->name?></span>
            <h4><?=$item->title?></h4>
        </div>

        <div>
            <img width="300px" src="../uploads/photoes/<?=$item->photo?>">
        </div>
        <p>likes:<span id="id_<?=$item->id?>"><?=$item->likes == null?0:$item->likes?></span>
            <?=Html::Button('赞',['id'=>$item->id,'style'=>$islike?'display:none':'']) ?>
        </p>
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


