<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news_cat".
 *
 * @property integer $news_id
 * @property integer $cat_id
 *
 * @property News $news
 * @property NewsCategory $cat
 */
class NewsCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'cat_id'], 'required'],
            [['news_id', 'cat_id'], 'integer'],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'news_id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsCategory::className(), 'targetAttribute' => ['cat_id' => 'cat_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => Yii::t('app', 'News ID'),
            'cat_id' => Yii::t('app', 'Cat ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['news_id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(NewsCategory::className(), ['cat_id' => 'cat_id']);
    }

    /**
     * @inheritdoc
     * @return NewsCatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsCatQuery(get_called_class());
    }
}
