<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_tag".
 *
 * @property integer $pro_ID
 * @property integer $tag_id
 *
 * @property Tag $tag
 * @property Product $pro
 */
class ProductTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_ID', 'tag_id'], 'required'],
            [['pro_ID', 'tag_id'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'tag_id']],
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
            'tag_id' => Yii::t('app', 'Tag ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['tag_id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Product::className(), ['pro_ID' => 'pro_ID']);
    }

    /**
     * @inheritdoc
     * @return ProductTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductTagQuery(get_called_class());
    }
}
