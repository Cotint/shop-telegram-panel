<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[NewsCat]].
 *
 * @see NewsCat
 */
class NewsCatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return NewsCat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NewsCat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
