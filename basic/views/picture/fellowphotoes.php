<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Fellow;

$this->context->layout = 'layout1';
$this->title = '关注';
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
    <div id="stage">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2 avator">
                        <img src="../uploads/<?=$user->avatar?>" alt="avator" class="rounded-circle">
                    </div>
                    <div class="col-10">
                        <?=Html::a($user->name,['member/card','uid'=>$user->uid])?>
                    </div>
                </div>
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


