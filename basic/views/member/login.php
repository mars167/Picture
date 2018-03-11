<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->context->layout = 'layout3';
$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="stage">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => '
                        <div class="form-group">
					   	    {label}
					   	    {input}
					   	</div>
                    ',
                ],
            ]); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true,'placeholder'=>'请输入用户名']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'请输入用户名']) ?>

                <?= $form->field($model, 'rememberme')->checkbox([
                    'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>


                <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <br>
                还没有账号？<?=Html::a('注册',['member/signup'])?>


            <?php ActiveForm::end(); ?>

            <div class="col-lg-offset-1" style="color:#999;">
                你可以用测试账号登录 <strong>admin/123456</strong>
            </div>
        </div>
    </div>
</div>