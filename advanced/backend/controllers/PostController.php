<?php
namespace backend\controllers;
use yii\web\controller;
use Yii;
use backend\models\Post;

class PostController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNew()
    {
        $model = new Post;

        if($model->load( Yii::$app->request->post() ) && $model->validate() )
        {
            $model->save();
            return $this->render('_show',['model'=>$model]);
        }else
        {
            return $this->render('_form',['model'=>$model]);
        }
        
    }
}
?>