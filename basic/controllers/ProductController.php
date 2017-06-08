<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductTag;
use app\models\ProCat;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\models\Category;
use app\models\Tag;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->created_at = time();
        $filename = uniqid();
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        if ($model->load(Yii::$app->request->post())) {
            if ($_FILES['Product']['name']['image'] != '') {
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->pro_thumb=$filename;
                if ($model->save()) {
                    if ($model->upload($filename)) {
                        $cats = Yii::$app->request->post()['Product']['cats'];
                        foreach ($cats as $key => $value) {
                            $Category = Category::findOne($value);
                            $model->link('cats', $Category);
                        }
                        $tags = Yii::$app->request->post()['Product']['tags'];
                        foreach ($tags as $key => $value) {
                            $tag = Tag::findOne($value);
                            $model->link('tags', $tag);
                        }
                        return $this->redirect(['view', 'id' => $model->pro_ID]);
                    }
                }
            } else {
                if ($model->save()) {
                    $cats = Yii::$app->request->post()['Product']['cats'];
                    foreach ($cats as $key => $value) {
                        $Category = Category::findOne($value);
                        $model->link('cats', $Category);
                    }
                    $tags = Yii::$app->request->post()['Product']['tags'];
                    foreach ($tags as $key => $value) {
                        $tag = Tag::findOne($value);
                        $model->link('tags', $tag);
                    }
                    return $this->redirect(['view', 'id' => $model->pro_ID]);
                }
            }
            return $this->redirect(['view', 'id' => $model->pro_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
                'tags' => $tags,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = Category::getCategories();
        $tags = Tag::getTags();
        if ($model->load(Yii::$app->request->post())) {
            ProCat::deleteAll(['pro_ID' => $id]);
            ProductTag::deleteAll(['pro_ID' => $id]);
            $thumb = $_POST['Product']['pro_thumb'];
           if ($_FILES['Product']['name']['image'] != '') {
                $filename = uniqid();
                $model->deleteImg($thumb);
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->pro_thumb=$filename;
                if ($model->save()) {
                    if ($model->upload($filename)) {
                        $cats = Yii::$app->request->post()['Product']['cats'];
                        foreach ($cats as $key => $value) {
                            $Category = Category::findOne($value);
                            $model->link('cats', $Category);
                        }
                        $tags = Yii::$app->request->post()['Product']['tags'];
                        foreach ($tags as $key => $value) {
                            $tag = Tag::findOne($value);
                            $model->link('tags', $tag);
                        }
                        return $this->redirect(['view', 'id' => $model->pro_ID]);
                    }
                }
            } else {
                $model->save();
                $cats = Yii::$app->request->post()['Product']['cats'];
                foreach ($cats as $key => $value) {
                    $Category = Category::findOne($value);
                    $model->link('cats', $Category);
                }
                $tags = Yii::$app->request->post()['Product']['tags'];
                foreach ($tags as $key => $value) {
                    $tag = Tag::findOne($value);
                    $model->link('tags', $tag);
                }
            }
            return $this->redirect(['view', 'id' => $model->pro_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
                'tags' => $tags,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        ProductTag::deleteAll(['pro_ID' => $id]);
        ProCat::deleteAll(['pro_ID' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
