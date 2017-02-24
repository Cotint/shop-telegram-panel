<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property integer $bra_ID
 * @property string $bra_Name
 * @property string $bra_Description
 * @property integer $bra_ImID
 */
class Brands extends \yii\db\ActiveRecord
{
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
            [['bra_ID', 'bra_Name', 'bra_Description', 'bra_ImID'], 'required'],
            [['bra_ID', 'bra_ImID'], 'integer'],
            [['bra_Description'], 'string'],
            [['bra_Name'], 'string', 'max' => 50],
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
        ];
    }
}
