<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;



$this->title = '上传照片';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$form = ActiveForm::begin([


]);
?>
    <?=$form->field($model,'imageTitle')->textInput() ?>
    <?=$form->field($model,'imageFile')->fileInput() ?>
    <?if(!$model->isNewRecord):
        echo Html::activeHiddenInput($model, 'imageFile');
    endif;
    ?>
    <?=Html::submitButton('提交') ?>
<?php $form = ActiveForm::end();?>




