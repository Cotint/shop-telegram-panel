<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[NewsCategory]].
 *
 * @see NewsCategory
 */
class NewsCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return NewsCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NewsCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
