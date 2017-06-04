<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
                      'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','update','delete','index','view'],
                'rules' => [
                    [
                        // 'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $model->created_at= time();
        $filename = uniqid();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->post()['Category']['cat_parentID'] == '') {
                $model->cat_parentID = 0;
            }
            if ($_FILES['Category']['name']['image'] != '') {
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->cat_thumb=$filename;
                if ($model->save()) {
                    if ($model->upload($filename)) {
                        return $this->redirect(['view', 'id' => $model->cat_ID]);
                    }
                }
            } else {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->cat_ID]);
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
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $thumb = $_POST['Category']['cat_thumb'];
            if ($_FILES['Category']['name']['image'] != '') {
                $filename = uniqid();
                $model->deleteImg($thumb);
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->cat_thumb=$filename;
                if ($model->save()) {
                    if ($model->upload($filename)) {
                        return $this->redirect(['view', 'id' => $model->cat_ID]);
                    }
                }
            } else {
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->cat_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
