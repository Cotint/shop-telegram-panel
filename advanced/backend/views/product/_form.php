<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pro_ID')->textInput() ?>

    <?= $form->field($model, 'pro_Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pro_CatID')->textInput() ?>

    <?= $form->field($model, 'pro_ImID')->textInput() ?>

    <?= $form->field($model, 'pro_BraID')->textInput() ?>

    <?= $form->field($model, 'pro_LikeCount')->textInput() ?>

    <?= $form->field($model, 'pro_DislikeCount')->textInput() ?>

    <?= $form->field($model, 'pro_FirstPrice')->textInput() ?>

    <?= $form->field($model, 'pro_LastPrice')->textInput() ?>

    <?= $form->field($model, 'pro_OffPrice')->textInput() ?>

    <?= $form->field($model, 'pro_BasketCount')->textInput() ?>

    <?= $form->field($model, 'pro_CoID')->textInput() ?>

    <?= $form->field($model, 'pro_TagID')->textInput() ?>

    <?= $form->field($model, 'pro_Code')->textInput() ?>

    <?= $form->field($model, 'pro_Description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
