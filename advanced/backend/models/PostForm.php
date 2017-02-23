<?php
namespace backend\models;

use yii\base\Model;

class PostForm extends Model
{
    public $title;
    public $content;
    public $date_add;

    public function rules()
    {
        return [
            [['title','content','date_add'],'required'],
            ['date_add','integer']
        ];
    }
}
?>