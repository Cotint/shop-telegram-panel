<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "product".
 *
 * @property integer $pro_ID
 * @property string $pro_Name
 * @property integer $pro_ImID
 * @property integer $pro_BraID
 * @property integer $pro_LikeCount
 * @property integer $pro_DislikeCount
 * @property integer $pro_FirstPrice
 * @property integer $pro_LastPrice
 * @property integer $pro_OffPrice
 * @property integer $pro_CoID
 * @property integer $pro_TagID
 * @property integer $pro_Code
 * @property string $pro_Description
 * @property string $pro_thumb
 * @property string $created_at
 * @property integer $telegram_send
 *
 * @property ProCat[] $proCats
 * @property Category[] $cats
 * @property Brands $proBra
 * @property ProductTag[] $productTags 
 */
class Product extends \yii\db\ActiveRecord
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
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_Name', 'pro_FirstPrice', 'created_at'], 'required'],
            [['pro_ImID', 'pro_BraID', 'pro_LikeCount', 'pro_DislikeCount', 'pro_FirstPrice', 'pro_LastPrice', 'pro_OffPrice', 'pro_CoID', 'pro_TagID', 'pro_Code'], 'integer'],
            [['pro_Description'], 'string'],
            [['pro_Name'], 'string', 'max' => 50],
            [['pro_thumb'], 'string', 'max' => 200],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            'pro_ImID' => Yii::t('app', 'Pro  Im ID'),
            'pro_BraID' => Yii::t('app', 'Pro  Bra ID'),
            'pro_LikeCount' => Yii::t('app', 'Pro  Like Count'),
            'pro_DislikeCount' => Yii::t('app', 'Pro  Dislike Count'),
            'pro_FirstPrice' => Yii::t('app', 'Pro  First Price'),
            'pro_LastPrice' => Yii::t('app', 'Pro  Last Price'),
            'pro_OffPrice' => Yii::t('app', 'Pro  Off Price'),
            'pro_CoID' => Yii::t('app', 'Pro  Co ID'),
            'pro_TagID' => Yii::t('app', 'Pro  Tag ID'),
            'pro_Code' => Yii::t('app', 'Pro  Code'),
            'pro_Description' => Yii::t('app', 'Pro  Description'),
            'pro_thumb' => Yii::t('app', 'Pro Thumb'),
            'created_at' => Yii::t('app', 'Created At'),
            'telegram_send' => Yii::t('app', 'Telegram Send'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProCats()
    {
        return $this->hasMany(ProCat::className(), ['pro_ID' => 'pro_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCats()
    {
        return $this->hasMany(Category::className(), ['cat_ID' => 'cat_ID'])->viaTable('proCat', ['pro_ID' => 'pro_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProBra()
    {
        return $this->hasOne(Brands::className(), ['bra_ID' => 'pro_BraID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['pro_ID' => 'pro_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['tag_id' => 'tag_id'])->viaTable('product_tag', ['pro_ID' => 'pro_ID']);
    }


    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public function upload($filename)
    {
        $this->image->saveAs('../web/pro_image/original/' . $filename . '.jpg');

        Image::thumbnail ('../web/pro_image/original/' . $filename . '.jpg',300,200)
        ->save('../web/pro_image/small/' . $filename . '.jpg', ['quality' => 150]);

        return true;
    }

    public function deleteImg($filename){
        unlink('../web/pro_image/small/' . $filename . '.jpg');
        unlink('../web/pro_image/original/' . $filename . '.jpg');
    }
}
