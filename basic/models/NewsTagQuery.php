<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[NewsTag]].
 *
 * @see NewsTag
 */
class NewsTagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return NewsTag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NewsTag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
