<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pro_ID') ?>

    <?= $form->field($model, 'pro_Name') ?>

    <?= $form->field($model, 'pro_CatID') ?>

    <?= $form->field($model, 'pro_ImID') ?>

    <?= $form->field($model, 'pro_BraID') ?>

    <?php // echo $form->field($model, 'pro_LikeCount') ?>

    <?php // echo $form->field($model, 'pro_DislikeCount') ?>

    <?php // echo $form->field($model, 'pro_FirstPrice') ?>

    <?php // echo $form->field($model, 'pro_LastPrice') ?>

    <?php // echo $form->field($model, 'pro_OffPrice') ?>

    <?php // echo $form->field($model, 'pro_BasketCount') ?>

    <?php // echo $form->field($model, 'pro_CoID') ?>

    <?php // echo $form->field($model, 'pro_TagID') ?>

    <?php // echo $form->field($model, 'pro_Code') ?>

    <?php // echo $form->field($model, 'pro_Description') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
