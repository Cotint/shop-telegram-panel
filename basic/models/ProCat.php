<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pro_cat".
 *
 * @property integer $pro_ID
 * @property integer $cat_ID
 *
 * @property Category $cat
 * @property Product $pro
 */
class ProCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proCat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_ID', 'cat_ID'], 'required'],
            [['pro_ID', 'cat_ID'], 'integer'],
            [['cat_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_ID' => 'cat_ID']],
            [['pro_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['pro_ID' => 'pro_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_ID' => Yii::t('app', 'Pro  ID'),
            'cat_ID' => Yii::t('app', 'Cat  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['cat_ID' => 'cat_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Product::className(), ['pro_ID' => 'pro_ID']);
    }
}
