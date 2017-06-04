<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Brands]].
 *
 * @see Brands
 */
class BrandsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Brands[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Brands|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
