<?php

namespace app\controllers;

use Yii;
use app\models\NewsCategory;
use app\models\NewsCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewsCategoryController implements the CRUD actions for NewsCategory model.
 */
class NewsCategoryController extends Controller
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
     * Lists all NewsCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewsCategory model.
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
     * Creates a new NewsCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewsCategory();
        $model->created_at= time();
        $filename = uniqid();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->post()['NewsCategory']['cat_parent_id'] == '') {
                $model->cat_parent_id = 0;
            }
            if ($_FILES['NewsCategory']['name']['image'] != '') {
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->cat_thumb=$filename;
                if ($model->save()) {
                    if ($model->upload($filename)) {
                        return $this->redirect(['view', 'id' => $model->cat_id]);
                    }
                }
            } else {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->cat_id]);
                }
            }
            return $this->redirect(['view', 'id' => $model->bra_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing NewsCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $thumb = $_POST['NewsCategory']['cat_thumb'];
            if ($_FILES['NewsCategory']['name']['image'] != '') {
                $filename = uniqid();
                $model->deleteImg($thumb);
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->cat_thumb=$filename;
                if ($model->save()) {
                    if ($model->upload($filename)) {
                        return $this->redirect(['view', 'id' => $model->cat_id]);
                    }
                }
            } else {
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->cat_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing NewsCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NewsCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NewsCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewsCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
