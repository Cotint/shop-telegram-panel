<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\NewsCategory;
use app\models\Tag;
use app\models\NewsTag;
use app\models\NewsCat;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $model->created_at= time();
        $filename = uniqid();
        $categories = NewsCategory::getCategories();
        $tags = Tag::getTags();
        if ($model->load(Yii::$app->request->post())) {
            if ($_FILES['News']['name']['image'] != '') {
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->news_thumb=$filename;
                if ($model->save()) {
                    $cats = Yii::$app->request->post()['News']['cats'];
                    foreach ($cats as $key => $value) {
                        $newsCategory = NewsCategory::findOne($value);
                        $model->link('cats', $newsCategory);
                    }
                    $tags = Yii::$app->request->post()['News']['tags'];
                    foreach ($tags as $key => $value) {
                        $tag = Tag::findOne($value);
                        $model->link('tags', $tag);
                    }
                    if ($model->upload($filename)) {
                        return $this->redirect(['view', 'id' => $model->news_id]);

                    }
                }
            } else {
                if ($model->save()) {
                    $cats = Yii::$app->request->post()['News']['cats'];
                    foreach ($cats as $key => $value) {
                        $newsCategory = NewsCategory::findOne($value);
                        $model->link('cats', $newsCategory);
                    }
                    $tags = Yii::$app->request->post()['News']['tags'];
                    foreach ($tags as $key => $value) {
                        $tag = Tag::findOne($value);
                        $model->link('tags', $tag);
                    }
                    return $this->redirect(['view', 'id' => $model->news_id]);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
                'tags' => $tags,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = NewsCategory::getCategories();
        $tags = Tag::getTags();
        if ($model->load(Yii::$app->request->post())) {
            NewsCat::deleteAll(['news_id' => $id]);
            NewsTag::deleteAll(['news_id' => $id]);
            $thumb = $_POST['News']['news_thumb'];
            if ($_FILES['News']['name']['image'] != '') {
                $filename = uniqid();
                $model->deleteImg($thumb);
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->news_thumb=$filename;
                if ($model->save()) {
                    $cats = Yii::$app->request->post()['News']['cats'];
                    foreach ($cats as $key => $value) {
                        $newsCategory = NewsCategory::findOne($value);
                        $model->link('cats', $newsCategory);
                    }
                    $tags = Yii::$app->request->post()['News']['tags'];
                    foreach ($tags as $key => $value) {
                        $tag = Tag::findOne($value);
                        $model->link('tags', $tag);
                    }
                    if ($model->upload($filename)) {
                        return $this->redirect(['view', 'id' => $model->news_id]);
                    }
                }
            } else {
                $model->save();
                $cats = Yii::$app->request->post()['News']['cats'];
                foreach ($cats as $key => $value) {
                    $newsCategory = NewsCategory::findOne($value);
                    $model->link('cats', $newsCategory);
                }
                $tags = Yii::$app->request->post()['News']['tags'];
                foreach ($tags as $key => $value) {
                    $tag = Tag::findOne($value);
                    $model->link('tags', $tag);
                }
            }
            return $this->redirect(['view', 'id' => $model->news_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
                'tags' => $tags,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        NewsTag::deleteAll(['news_id' => $id]);
        NewsCat::deleteAll(['news_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
