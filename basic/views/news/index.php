<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\News;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create News'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'تصویر',
                'format' => 'html',
                'value' => function($model, $index, $dataColumn) {
                    if ($model->news_thumb != null) {
                        return '<img src="../web/news_image/small/'.$model->news_thumb.'.jpg" width="70" />';                        # code...
                    }
                },
            ],
            'news_title',
            'news_description',
            [
                'label' => 'تگ',
                'format' => 'html',
                'value' => function($model, $index, $dataColumn) {
                    $query = News::find()->with('tags')->where(['news_id' => $model->news_id])->one();
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
<?php Pjax::end(); ?></div>
