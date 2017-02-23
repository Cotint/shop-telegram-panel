<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pro_ID',
            'pro_Name',
            'pro_CatID',
            'pro_ImID',
            'pro_BraID',
            // 'pro_LikeCount',
            // 'pro_DislikeCount',
            // 'pro_FirstPrice',
            // 'pro_LastPrice',
            // 'pro_OffPrice',
            // 'pro_BasketCount',
            // 'pro_CoID',
            // 'pro_TagID',
            // 'pro_Code',
            // 'pro_Description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
