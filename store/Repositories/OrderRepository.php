<?php


namespace app\store\Repositories;


use app\store\Entities\Order\Order;
use yii\web\NotFoundHttpException;

class OrderRepository
{
	public function get($id): Order
	{
		if (!$order = Order::findOne($id)) {
			throw new NotFoundHttpException('Заказ не найден.');
		}
		return $order;
	}

	public function save(Order $order): void
	{
		if (!$order->save()) {
			throw new \RuntimeException('Ошибка сохранаения.');
		}
	}

	public function remove(Order $order): void
	{
		if (!$order->delete()) {
			throw new \RuntimeException('Ошибка удалениия.');
		}
	}
}
