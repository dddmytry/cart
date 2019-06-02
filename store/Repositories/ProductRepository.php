<?php


namespace app\store\Repositories;


use app\store\Entities\Product\Product;
use yii\web\NotFoundHttpException;

class ProductRepository
{
	public function get($id): Product
	{
		if (!$product = Product::findOne($id)) {
			throw new NotFoundHttpException('Товар не найден.');
		}
		return $product;
	}

	public function save(Product $product): void
	{
		if (!$product->save()) {
			throw new \RuntimeException('Ошибка сохранения.');
		}
	}

	public function remove(Product $product): void
	{
		if (!$product->delete()) {
			throw new \RuntimeException('Ошибка удаления.');
		}
	}
}
