<?php

namespace app\modules\admin\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\store\Entities\Product\Product;

/**
 * ProductSearch represents the model behind the search form of `app\store\Entities\Product\Product`.
 */
class ProductSearch extends Model
{
	public $id;
	public $price;
	public $name;
	public $status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price'], 'integer'],
            [['name', 'status'], 'safe'],
        ];
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
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
