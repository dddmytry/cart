<?php

namespace app\modules\admin\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\store\Entities\Order\Order;

/**
 * OrderSearch represents the model behind the search form of `app\store\Entities\Order\Order`.
 */
class OrderSearch extends Model
{
	public $id;
	public $customer_email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['customer_email'], 'safe'],
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
        $query = Order::find();

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
        ]);

        $query->andFilterWhere(['like', 'customer_email', $this->customer_email]);

        return $dataProvider;
    }
}
