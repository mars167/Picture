<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$this->context->layout = 'layout2';
$this->title = '上传照片';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="stage">
    <div class="card">
        <div class="card-body">
            <?php
            $form = ActiveForm::begin([
                'fieldConfig' =>[
                    'template'=>'
                        <div class="form-group">
                                {label}
                                {input}
                        </div>
                    ',
                ]

            ]);
            ?>
                <?=$form->field($model,'imageTitle')->textInput(['class'=>'form-control']) ?>
                <?=$form->field($model,'imageFile')->fileInput(['class'=>'form-control-file btn']) ?>
                <?if(!$model->isNewRecord):
                    echo Html::activeHiddenInput($model, 'imageFile');
                endif;
                ?>
                <div class="row">
                    <div class="col-6">
                        <?=Html::submitButton('提交',['class'=>'btn btn-primary btn-block']) ?>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-secondary btn-block" onclick="window.history.go(-1)" href="#">取消</a>
                    </div>
                </div>
            <?php $form = ActiveForm::end();?>
        </div>
    </div>
</div>




