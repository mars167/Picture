
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->context->layout = 'layout3';
$this->title = '注册';
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
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>
                <?=$form->field($model,'name')->textInput(['placeholder'=>'请输入用户名'])?>

                <?=$form->field($model,'password')->passwordInput(['placeholder'=>'请输入密码'])?>

                <?=$form->field($model,'email')->input('email',['placeholder'=>'请输入邮箱'])?>

                <?=$form->field($model,'sex')->radioList(['1'=>'男','0'=>'女'])?>

                <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <br>
                已有有账号？<?=Html::a('登录',['member/login'])?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>