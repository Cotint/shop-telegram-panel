<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\NewsCategory;
use yii\helpers\ArrayHelper;
use app\models\Tag;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'news_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
<?php
$data1 = ArrayHelper::map($categories, 'cat_id', 'cat_name');
echo $form->field($model, 'cats')->widget(Select2::classname(), [
    'data' => $data1,
    'options' => ['placeholder' => 'دسته را انتخاب کنید', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10
    ],
])->label('انتخاب دسته');
?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'news_description')->textarea(['rows' => 6]) ?>
    </div>
    <div class="col-md-6">
<?php
$data2 = ArrayHelper::map($tags, 'tag_id', 'tag_name');
echo $form->field($model, 'tags')->widget(Select2::classname(), [
    'data' => $data2,
    'options' => ['placeholder' => 'تگ را انتخاب کنید', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10
    ],
])->label('انتخاب تگ');
?>
    </div>
</div>
    
    <?= $form->field($model, 'image')->fileInput() ?>

    <?php if ($model->isNewRecord == false): ?>
        <?=$form->field($model, 'news_thumb')->hiddenInput()->label(false); ?>
    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
