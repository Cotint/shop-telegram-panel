<?php

namespace app\controllers;

use Yii;
use app\models\Brands;
use app\models\BrandsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class BrandsController extends Controller
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
     * Lists all Brands models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BrandsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brands model.
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
     * Creates a new Brands model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Brands();
        $model->created_at= time();
        $filename = uniqid();
        if ($model->load(Yii::$app->request->post())) {
            if ($_FILES['Brands']['name']['image'] != '') {
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->bra_thumb=$filename;
                if ($model->save()) {
                    if ($model->upload($filename)) {
                        return $this->redirect(['view', 'id' => $model->bra_ID]);
                    }
                }
            } else {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->bra_ID]);
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
     * Updates an existing Brands model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
           $thumb = $_POST['Brands']['bra_thumb'];
            if ($_FILES['Brands']['name']['image'] != '') {
                $filename = uniqid();
                $model->deleteImg($thumb);
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->bra_thumb=$filename;
                if ($model->save()) {
                    if ($model->upload($filename)) {
                        return $this->redirect(['view', 'id' => $model->bra_ID]);
                    }
                }
            } else {
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->bra_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Brands model.
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
     * Finds the Brands model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brands the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brands::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
