<?php


namespace app\store\Services\Cart;


use app\store\Entities\cart\Cart;
use app\store\Entities\cart\CartItem;
use app\store\Repositories\ProductRepository;

class CartService
{
	private $products;
	private $cart;

	public function __construct(ProductRepository $products, Cart $cart)
	{
		$this->products = $products;
		$this->cart = $cart;
	}

	public function  getCart(): Cart
	{
		return $this->cart;
	}

	public function add($id, $quantity): void
	{
		$product = $this->products->get($id);
		$this->cart->add(new CartItem($product, $quantity));
	}

	public function set($id, $quantity): void
	{
		$this->cart->set($id, $quantity);
	}

	public function remove($id): void
	{
		$this->cart->remove($id);
	}

	public function clear(): void
	{
		$this->cart->clear();
	}
}
