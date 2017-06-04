<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Category;
use app\models\Brands;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
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
            [
                'label' => 'تصویر',
                'format' => 'html',
                'value' => function($model, $index, $dataColumn) {
                    if ($model->pro_thumb != null) {
                        return '<img src="../web/pro_image/small/'.$model->pro_thumb.'.jpg" width="70" />';
                    }
                },
            ],
            [
                'label' => 'نام برند',
                'format' => 'html',
                'value' => function($model, $index, $dataColumn) {
                    return $model->proBra['bra_Name'];
                },
            ],
            'pro_Name',
            'pro_FirstPrice',
            'pro_LastPrice',
            [
                'label' => 'دسته',
                'format' => 'html',
                'value' => function($model, $index, $dataColumn) {
                    $query = Product::find()->with('cats')->where(['pro_ID' => $model->pro_ID])->one();
                    $text = '';
                    foreach ($query->cats as $key => $value) {
                        $text .= $value['cat_Name'].'<br>';
                    }
                    return $text;
                },
            ],
            [
                'label' => 'تگ',
                'format' => 'html',
                'value' => function($model, $index, $dataColumn) {
                    $query = Product::find()->with('tags')->where(['pro_ID' => $model->pro_ID])->one();
                    $text = '';
                    foreach ($query->tags as $key => $value) {
                        $text .= '#'.$value['tag_name'].'<br>';
                    }
                    return $text;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
