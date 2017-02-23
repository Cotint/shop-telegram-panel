<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $family
 * @property string $address
 * @property integer $phone
 * @property string $father
 * @property string $job
 * @property string $country
 * @property string $birthday
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'family', 'address', 'phone', 'father', 'job', 'country'], 'required'],
            [['phone'], 'integer'],
            [['birthday'], 'safe'],
            [['name', 'father'], 'string', 'max' => 40],
            [['family', 'job', 'country'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'family' => Yii::t('app', 'Family'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'father' => Yii::t('app', 'Father'),
            'job' => Yii::t('app', 'Job'),
            'country' => Yii::t('app', 'Country'),
            'birthday' => Yii::t('app', 'Birthday'),
        ];
    }
}
