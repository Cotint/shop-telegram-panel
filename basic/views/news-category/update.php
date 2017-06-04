<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NewsCategory */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'News Category',
]) . $model->cat_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cat_id, 'url' => ['view', 'id' => $model->cat_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="news-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
