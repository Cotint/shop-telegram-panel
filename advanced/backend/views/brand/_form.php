<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bra_ID')->textInput() ?>

    <?= $form->field($model, 'bra_Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bra_Description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bra_ImID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
