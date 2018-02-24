<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;



$this->title = '我的Picture';
$this->params['breadcrumbs'][] = $this->title;
$uid = \Yii::$app->session['uid'];
?>

<?php foreach ($model->showByUid($uid) as $item): ?>
    <div class="row">
        <div>
            <h4><?=$item->title?></h4>
        </div>

        <div>
            <img width="300px" src="../uploads/photoes/<?=$item->photo?>">
        </div>
        <p>likes:<?=$item->likes == null?0:$item->likes?></p>
        <span><?=$item->update_time?></span>
        <hr>
    </div>

<?php endforeach; ?>




