<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?=$form->field($model,'title'); ?>
<?=$form->field($model,'content'); ?>
<?=$form->field($model,'date_add'); ?>

<?= Html::submitButton('submit'); ?>

<?php ActiveForm::end(); ?>
