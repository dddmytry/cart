<?php


namespace app\store\Services\Order;


use app\store\Entities\cart\Cart;
use app\store\Entities\cart\CartItem;
use app\store\Entities\Order\Order;
use app\store\Entities\Order\OrderItem;
use app\store\Forms\Order\OrderForm;
use app\store\Repositories\OrderRepository;
use app\store\Repositories\ProductRepository;

class OrderService
{
	private $cart;
	private $orders;
	private $products;

	public function __construct(Cart $cart, OrderRepository $orders, ProductRepository $products)
	{
		$this->cart = $cart;
		$this->orders = $orders;
		$this->products = $products;
	}

	public function checkout(OrderForm $form): Order
	{
		$products = [];

		$items = array_map(function (CartItem $item) use ($products) {
			$product = $item->getProduct();
			$products[] = $product;
			return OrderItem::create(
				$product,
				$item->getPrice(),
				$item->getQuantity()
			);
		}, $this->cart->getItems());

		$order = Order::create(
			$form->customer_email,
			$items,
			$this->cart->getCost()->getOrigin()
		);

		$this->orders->save($order);
		$this->cart->clear();

		$day = date('w');
		$hour = date('H-i');

		if ($day != 0 && $day != 6) {
			if ($hour >= '08-00' && $hour <= '17-00') {
				$to = \Yii::$app->params['officeEmail'];
			} else {
				$to = \Yii::$app->params['adminEmail'];
			}
		}else {
			$to = \Yii::$app->params['adminEmail'];
		}

		$subject = 'You have new order from your site';
		$userEmail = $form->customer_email;

		$sent = \Yii::$app->mailer->compose(
			['html' => 'order/orderCreate-html', 'txt' => 'order/orderCreate-txt'],
			['userEmail' => $userEmail, 'order' => $order]
		)
			->setSubject($subject)
			->setFrom(\Yii::$app->params['senderEmail'])
			->setTo($to)
			->send();
		if (!$sent) {
			throw new \RuntimeException('Ошибка отправки. Попробуйте повторить позже.');
		}

		return $order;
	}
}
