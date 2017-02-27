<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_ID', 'cat_parentID', 'cat_imageID'], 'integer'],
            [['cat_Name', 'cat_Specification'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cat_ID' => $this->cat_ID,
            'cat_parentID' => $this->cat_parentID,
            'cat_imageID' => $this->cat_imageID,
        ]);

        $query->andFilterWhere(['like', 'cat_Name', $this->cat_Name])
            ->andFilterWhere(['like', 'cat_Specification', $this->cat_Specification]);

        return $dataProvider;
    }
}
