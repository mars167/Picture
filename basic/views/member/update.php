<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->context->layout = 'layout2';
$this->title = '修改个人信息';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="stage">

    <?php $form = ActiveForm::begin([
        'fieldConfig' =>[
            'template'=>'
                        <div class="form-group">
                            {label}
                            {input}
                        </div>
                    ',
        ]
    ]);?>

        <div class="card">
            <div class="card-body">
                <?=$form->field($model,'avatarFile')->fileInput(['class'=>'form-control-file']) ?>
                <?if(!$model->isNewRecord):
                    echo Html::activeHiddenInput($model, 'imageFile');
                endif;
                ?>

                <?=$form->field($model,'profile')->textarea(['value'=>$user->profile,'class'=>'form-control']) ?>

            </div>
        </div>
        <div class="card mt-5">
            <div class="row">
                <div class="col-12">
                    <?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-primary btn-block'])?>
                </div>
            </div>
        </div>

    <?php $form = ActiveForm::end(); ?>

</div>