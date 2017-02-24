<?php
namespace backend\models;
use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title','content','date_add'],'required'],
            ['date_add','integer']
        ];
    }
}