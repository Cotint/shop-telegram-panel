<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $cat_ID
 * @property string $cat_Name
 * @property integer $cat_parentID
 * @property string $cat_Specification
 * @property integer $cat_imageID
 */
class Category extends \yii\db\ActiveRecord
{
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
            [['cat_ID', 'cat_Name', 'cat_parentID', 'cat_Specification', 'cat_imageID'], 'required'],
            [['cat_ID', 'cat_parentID', 'cat_imageID'], 'integer'],
            [['cat_Name'], 'string', 'max' => 50],
            [['cat_Specification'], 'string', 'max' => 200],
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
        ];
    }
}
