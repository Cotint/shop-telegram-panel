<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_ID', 'pro_CatID', 'pro_ImID', 'pro_BraID', 'pro_LikeCount', 'pro_DislikeCount', 'pro_FirstPrice', 'pro_LastPrice', 'pro_OffPrice', 'pro_BasketCount', 'pro_CoID', 'pro_TagID', 'pro_Code'], 'integer'],
            [['pro_Name', 'pro_Description'], 'safe'],
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
        $query = Product::find();

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
            'pro_ID' => $this->pro_ID,
            'pro_CatID' => $this->pro_CatID,
            'pro_ImID' => $this->pro_ImID,
            'pro_BraID' => $this->pro_BraID,
            'pro_LikeCount' => $this->pro_LikeCount,
            'pro_DislikeCount' => $this->pro_DislikeCount,
            'pro_FirstPrice' => $this->pro_FirstPrice,
            'pro_LastPrice' => $this->pro_LastPrice,
            'pro_OffPrice' => $this->pro_OffPrice,
            'pro_BasketCount' => $this->pro_BasketCount,
            'pro_CoID' => $this->pro_CoID,
            'pro_TagID' => $this->pro_TagID,
            'pro_Code' => $this->pro_Code,
        ]);

        $query->andFilterWhere(['like', 'pro_Name', $this->pro_Name])
            ->andFilterWhere(['like', 'pro_Description', $this->pro_Description]);

        return $dataProvider;
    }
}
