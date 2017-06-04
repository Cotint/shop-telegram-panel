<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\NewsCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'cat_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?php $dataPostGroup=ArrayHelper::map($model::find()->where(['cat_parent_id' => 0])->asArray()->all(), 'cat_id', 'cat_name');
                    echo $form->field($model, 'cat_parent_id')
                    ->dropDownList($dataPostGroup, ['id'=>'cat_ID', 'prompt'=>'Select...']);
            ?>
        </div>
    </div>

        <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'cat_specification')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
           <?= $form->field($model, 'image')->fileInput() ?>
        </div>
    </div>
    
    <?php if ($model->isNewRecord == false): ?>
        <?=$form->field($model, 'cat_thumb')->hiddenInput()->label(false); ?>
    <?php endif ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
