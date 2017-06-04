<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "category".
 *
 * @property integer $cat_ID
 * @property string $cat_Name
 * @property integer $cat_parentID
 * @property string $cat_Specification
 * @property integer $cat_imageID
 * @property string $cat_thumb
 * @property string $created_at 
 *
 * @property NewsCat[] $newsCats 
 * @property News[] $news 
 * @property ProCat[] $proCats
 * @property Product[] $pros 
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_Name', 'created_at'], 'required'],
            [['cat_parentID', 'cat_imageID'], 'integer'],
            [['cat_Name'], 'string', 'max' => 50],
            [['cat_Specification'], 'string', 'max' => 200],
            [['cat_thumb'], 'string', 'max' => 200],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_ID' => Yii::t('app', 'Cat  ID'),
            'cat_Name' => Yii::t('app', 'Cat  Name'),
            'cat_parentID' => Yii::t('app', 'Cat Parent ID'),
            'cat_Specification' => Yii::t('app', 'Cat  Specification'),
            'cat_imageID' => Yii::t('app', 'Cat Image ID'),
            'cat_thumb' => Yii::t('app', 'Cat Thumb'),
            'created_at' => Yii::t('app', 'Created At'), 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsCats()
    {
        return $this->hasMany(NewsCat::className(), ['cat_id' => 'cat_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['news_id' => 'news_id'])->viaTable('news_cat', ['cat_id' => 'cat_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProCats()
    {
        return $this->hasMany(ProCat::className(), ['cat_ID' => 'cat_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPros()
    {
        return $this->hasMany(Product::className(), ['pro_ID' => 'pro_ID'])->viaTable('proCat', ['cat_ID' => 'cat_ID']);
    }

    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public function upload($filename)
    {
        $this->image->saveAs('../web/cat_image/original/' . $filename . '.jpg');

        Image::thumbnail ('../web/cat_image/original/' . $filename . '.jpg',300,200)
        ->save('../web/cat_image/small/' . $filename . '.jpg', ['quality' => 150]);

        return true;
    }

    public function deleteImg($filename){
        unlink('../web/cat_image/small/' . $filename . '.jpg');
        unlink('../web/cat_image/original/' . $filename . '.jpg');
    }

    public static function getCategories()
    {
        return Category::find()->select(['cat_ID', 'cat_Name'])->all();
    }
}
