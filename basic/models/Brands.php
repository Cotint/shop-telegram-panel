<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "brands".
 *
 * @property integer $bra_ID
 * @property string $bra_Name
 * @property string $bra_Description
 * @property integer $bra_ImID
 * @property string $bra_thumb
 * @property string $created_at 
 *
 * @property Product[] $products
 */
class Brands extends \yii\db\ActiveRecord
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
        return 'brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bra_Name', 'created_at'], 'required'],
            [['bra_Description'], 'string'],
            [['bra_ImID'], 'integer'],
            [['bra_Name'], 'string', 'max' => 50],
            [['bra_thumb'], 'string', 'max' => 200],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bra_ID' => Yii::t('app', 'Bra  ID'),
            'bra_Name' => Yii::t('app', 'Bra  Name'),
            'bra_Description' => Yii::t('app', 'Bra  Description'),
            'bra_ImID' => Yii::t('app', 'Bra  Im ID'),
            'bra_thumb' => Yii::t('app', 'Bra Thumb'),
            'created_at' => Yii::t('app', 'Created At'), 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['pro_BraID' => 'bra_ID']);
    }

    /**
     * @inheritdoc
     * @return BrandsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BrandsQuery(get_called_class());
    }
    
    public function upload($filename)
    {
        $this->image->saveAs('../web/brand_image/original/' . $filename . '.jpg');

        Image::thumbnail ('../web/brand_image/original/' . $filename . '.jpg',300,200)
        ->save('../web/brand_image/small/' . $filename . '.jpg', ['quality' => 150]);

        return true;
    }

    public function deleteImg($filename){
        unlink('../web/brand_image/small/' . $filename . '.jpg');
        unlink('../web/brand_image/original/' . $filename . '.jpg');
    }
}
