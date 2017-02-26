<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Brands',
]) . $model->bra_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bra_ID, 'url' => ['view', 'id' => $model->bra_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="brands-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
