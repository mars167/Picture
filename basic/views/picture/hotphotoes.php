<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;



$this->title = 'Picture（热门）';
$this->params['breadcrumbs'][] = $this->title;
$userModel = new \app\models\User;

?>
<?php foreach ($model->showByLikes() as $item): ?>
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
        <p>likes:<?=$item->likes == null?0:$item->likes?></p>
        <span><?=$item->update_time?></span>
        <hr>
    </div>

<?php endforeach; ?>




