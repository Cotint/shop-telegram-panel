<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "news_category".
 *
 * @property integer $cat_id
 * @property string $cat_name
 * @property integer $cat_parent_id
 * @property string $cat_specification
 * @property string $cat_thumb
 * @property string $created_at
 *
 * @property NewsCat[] $newsCats
 * @property News[] $news 
 */
class NewsCategory extends \yii\db\ActiveRecord
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
        return 'news_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name', 'created_at'], 'required'],
            [['cat_parent_id'], 'integer'],
            [['cat_name', 'cat_specification', 'cat_thumb'], 'string', 'max' => 200],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => Yii::t('app', 'Cat ID'),
            'cat_name' => Yii::t('app', 'Cat Name'),
            'cat_parent_id' => Yii::t('app', 'Cat Parent ID'),
            'cat_specification' => Yii::t('app', 'Cat Specification'),
            'cat_thumb' => Yii::t('app', 'Cat Thumb'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsCats()
    {
        return $this->hasMany(NewsCat::className(), ['cat_id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['news_id' => 'news_id'])->viaTable('news_cat', ['cat_id' => 'cat_id']);
    }

    /**
     * @inheritdoc
     * @return NewsCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsCategoryQuery(get_called_class());
    }

    public function upload($filename)
    {
        $this->image->saveAs('../web/cat_news_image/original/' . $filename . '.jpg');

        Image::thumbnail ('../web/cat_news_image/original/' . $filename . '.jpg',300,200)
        ->save('../web/cat_news_image/small/' . $filename . '.jpg', ['quality' => 150]);

        return true;
    }

    public function deleteImg($filename){
        unlink('../web/cat_news_image/small/' . $filename . '.jpg');
        unlink('../web/cat_news_image/original/' . $filename . '.jpg');
    }

    public static function getCategories()
    {
        return NewsCategory::find()->select(['cat_id', 'cat_name'])->all();
    }
}
