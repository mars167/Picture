<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = '修改个人信息';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin([

]);?>

    <?=$form->field($model,'avatarFile')->fileInput() ?>
    <?if(!$model->isNewRecord):
        echo Html::activeHiddenInput($model, 'imageFile');
    endif;
    ?>
    <?=$form->field($model,'profile')->textarea(['value'=>$user->profile]) ?>
    <?=\yii\helpers\Html::submitButton('提交')?>

<?php $form = ActiveForm::end(); ?>