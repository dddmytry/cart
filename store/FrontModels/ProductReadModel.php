<?php


namespace app\store\FrontModels;


use app\store\Entities\Product\Product;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class ProductReadModel
{
	public function getAll(): DataProviderInterface
	{
		$query = Product::find()->andWhere(['status' => Product::STATUS_ACTIVE])->with('mainPhoto');
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => ['id' => SORT_ASC],
			],
		]);
		return $dataProvider;
	}

	public function findBySlug(string $slug): ?Product
	{
		return Product::findOne(['slug' => $slug]);
	}
}
