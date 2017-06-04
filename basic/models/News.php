<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "news".
 *
 * @property integer $news_id
 * @property string $news_title
 * @property string $news_thumb
 * @property string $news_description
 * @property integer $news_tag
 * @property string $created_at 
 * @property integer $telegram_send
 *
 * @property NewsCat[] $newsCats
 * @property NewsCategory[] $cats
 * @property NewsTag[] $newsTags
 * @property Tag[] $tags
 */
class News extends \yii\db\ActiveRecord
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
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_description', 'created_at'], 'required'],
            [['news_tag'], 'integer'],
            [['news_description'], 'string'],
            [['news_title', 'news_thumb', 'news_description'], 'string', 'max' => 200],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => Yii::t('app', 'News ID'),
            'news_title' => Yii::t('app', 'News Title'),
            'news_thumb' => Yii::t('app', 'News Thumb'),
            'news_description' => Yii::t('app', 'News Description'),
            'news_tag' => Yii::t('app', 'News Tag'),
            'created_at' => Yii::t('app', 'Created At'),
            'telegram_send' => Yii::t('app', 'Telegram Send'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsCats()
    {
        return $this->hasMany(NewsCat::className(), ['news_id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCats()
    {
       return $this->hasMany(NewsCategory::className(), ['cat_id' => 'cat_id'])->viaTable('news_cat', ['news_id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsTags()
    {
        return $this->hasMany(NewsTag::className(), ['news_id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['tag_id' => 'tag_id'])->viaTable('news_tag', ['news_id' => 'news_id']);
    }

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    public function upload($filename)
    {
        $test = $this->image->saveAs('../web/news_image/original/' . $filename . '.jpg');

        $test2= Image::thumbnail ('../web/news_image/original/' . $filename . '.jpg',300,200)
        ->save('../web/news_image/small/' . $filename . '.jpg', ['quality' => 150]);

        return true;
    }

    public function deleteImg($filename){
        unlink('../web/news_image/small/' . $filename . '.jpg');
        unlink('../web/news_image/original/' . $filename . '.jpg');
    }
}
