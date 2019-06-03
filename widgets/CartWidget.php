<?php


namespace app\widgets;


use app\store\Entities\cart\Cart;
use yii\base\Widget;

class CartWidget extends Widget
{
	private $cart;

	public function __construct(Cart $cart, $config = [])
	{
		parent::__construct($config);
		$this->cart = $cart;
	}

	public function run()
	{
		return $this->render('cart', [
			'cart' => $this->cart,
		]);
	}
}
