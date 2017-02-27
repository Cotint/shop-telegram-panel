<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Brands;

/**
 * BrandsSearch represents the model behind the search form about `app\models\Brands`.
 */
class BrandsSearch extends Brands
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bra_ID', 'bra_ImID'], 'integer'],
            [['bra_Name', 'bra_Description'], 'safe'],
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
        $query = Brands::find();

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
            'bra_ID' => $this->bra_ID,
            'bra_ImID' => $this->bra_ImID,
        ]);

        $query->andFilterWhere(['like', 'bra_Name', $this->bra_Name])
            ->andFilterWhere(['like', 'bra_Description', $this->bra_Description]);

        return $dataProvider;
    }
}
