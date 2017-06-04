<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'ورود';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Telegram</b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">لطفا وارد شوید</p>
    <!-- /.login-logo -->
        <h1><?= Html::encode($this->title) ?></h1>

        <p>لطفا فیلدهای زیر را برای ورود به پنل وارد کنید:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
        ]); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <?= Html::submitButton('ورود', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
        

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <!--<div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>-->
</div>
