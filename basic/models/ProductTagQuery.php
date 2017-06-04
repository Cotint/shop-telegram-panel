<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductTag]].
 *
 * @see ProductTag
 */
class ProductTagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProductTag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductTag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
