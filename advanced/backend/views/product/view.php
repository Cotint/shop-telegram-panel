<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->pro_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->pro_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->pro_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pro_ID',
            'pro_Name',
            'pro_CatID',
            'pro_ImID',
            'pro_BraID',
            'pro_LikeCount',
            'pro_DislikeCount',
            'pro_FirstPrice',
            'pro_LastPrice',
            'pro_OffPrice',
            'pro_BasketCount',
            'pro_CoID',
            'pro_TagID',
            'pro_Code',
            'pro_Description:ntext',
        ],
    ]) ?>

</div>
