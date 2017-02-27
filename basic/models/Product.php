<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $pro_ID
 * @property string $pro_Name
 * @property integer $pro_CatID
 * @property integer $pro_ImID
 * @property integer $pro_BraID
 * @property integer $pro_LikeCount
 * @property integer $pro_DislikeCount
 * @property integer $pro_FirstPrice
 * @property integer $pro_LastPrice
 * @property integer $pro_OffPrice
 * @property integer $pro_BasketCount
 * @property integer $pro_CoID
 * @property integer $pro_TagID
 * @property integer $pro_Code
 * @property string $pro_Description
 *
 * @property ProCat $proCat
 * @property Brands $proBra
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_ID', 'pro_Name', 'pro_CatID', 'pro_ImID', 'pro_BraID', 'pro_LikeCount', 'pro_DislikeCount', 'pro_FirstPrice', 'pro_LastPrice', 'pro_OffPrice', 'pro_BasketCount', 'pro_CoID', 'pro_TagID', 'pro_Code', 'pro_Description'], 'required'],
            [['pro_ID', 'pro_CatID', 'pro_ImID', 'pro_BraID', 'pro_LikeCount', 'pro_DislikeCount', 'pro_FirstPrice', 'pro_LastPrice', 'pro_OffPrice', 'pro_BasketCount', 'pro_CoID', 'pro_TagID', 'pro_Code'], 'integer'],
            [['pro_Description'], 'string'],
            [['pro_Name'], 'string', 'max' => 50],
            [['pro_BraID'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['pro_BraID' => 'bra_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_ID' => Yii::t('app', 'Pro  ID'),
            'pro_Name' => Yii::t('app', 'Pro  Name'),
            'pro_CatID' => Yii::t('app', 'Pro  Cat ID'),
            'pro_ImID' => Yii::t('app', 'Pro  Im ID'),
            'pro_BraID' => Yii::t('app', 'Pro  Bra ID'),
            'pro_LikeCount' => Yii::t('app', 'Pro  Like Count'),
            'pro_DislikeCount' => Yii::t('app', 'Pro  Dislike Count'),
            'pro_FirstPrice' => Yii::t('app', 'Pro  First Price'),
            'pro_LastPrice' => Yii::t('app', 'Pro  Last Price'),
            'pro_OffPrice' => Yii::t('app', 'Pro  Off Price'),
            'pro_BasketCount' => Yii::t('app', 'Pro  Basket Count'),
            'pro_CoID' => Yii::t('app', 'Pro  Co ID'),
            'pro_TagID' => Yii::t('app', 'Pro  Tag ID'),
            'pro_Code' => Yii::t('app', 'Pro  Code'),
            'pro_Description' => Yii::t('app', 'Pro  Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProCat()
    {
        return $this->hasOne(ProCat::className(), ['pro_ID' => 'pro_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProBra()
    {
        return $this->hasOne(Brands::className(), ['bra_ID' => 'pro_BraID']);
    }
}
