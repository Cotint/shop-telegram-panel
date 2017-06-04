<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NewsCategory */

$this->title = Yii::t('app', 'Create News Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
