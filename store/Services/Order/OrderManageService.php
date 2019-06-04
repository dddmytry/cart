<?php


namespace app\store\Services\Order;

use app\store\Forms\Order\OrderEditForm;
use app\store\Repositories\OrderRepository;

class OrderManageService
{
	private $orders;

	public function __construct(OrderRepository $orders)
	{
		$this->orders = $orders;
	}

	public function edit($id, OrderEditForm $form): void
	{
		$order = $this->orders->get($id);
		$order->edit($form->customer_email);
		$this->orders->save($order);
	}

	public function remove($id): void
	{
		$order = $this->orders->get($id);
		$this->orders->remove($order);
	}
}
