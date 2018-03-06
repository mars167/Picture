<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;



$this->title = 'Picture（最新）';
$this->params['breadcrumbs'][] = $this->title;
$userModel = new \app\models\User;
?>
<?php foreach ($model->showByTime() as $item): ?>
    <?php $user = $userModel->findeByUid($item->uid); ?>
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
            <?=Html::hiddenInput('uid', $user->uid, ['id' => 'i_'.$item->id])?>
            <?=Html::Button('赞',['id'=>$item->id]) ?>

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
           uid : $("#i_"+id).attr('value'),
           like : like
       },function(data,textStatus) {
           $("#id_"+id).html(like);
           alert(data);
       })
    })

JS;

$this->registerJs($js);
?>


