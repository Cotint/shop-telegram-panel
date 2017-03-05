<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\Brands;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pro_ID')->textInput() ?>

    <?= $form->field($model, 'pro_Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pro_CatID')->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(),'cat_ID','cat_Name'),
        ['prompt'=>'دسته مورد نظر را انتخاب کنید']
    ) ?>

    <?= $form->field($model, 'pro_ImID')->textInput() ?>

    <?= $form->field($model, 'pro_BraID')->textInput() ?>
    <?= $form->field($model, 'pro_BraID')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Brands::find()->all(),'bra_ID','bra_Name'),
        ['prompt'=>'برند مورد نظر را انتخاب کنید']
    ) ?>

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
