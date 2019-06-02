<?php


namespace app\store\Entities\cart;


use app\store\Entities\Product\Product;

class CartItem
{
	private $product;
	private $quantity;

	public function __construct(Product $product, int $quantity)
	{
		$this->product = $product;
		$this->quantity = $quantity;
	}

	public function getId(): string
	{
		return md5(serialize([$this->product->id]));
	}

	public function getProductId(): int
	{
		return $this->product->id;
	}

	public function getProduct(): Product
	{
		return $this->product;
	}

	public function getQuantity(): int
	{
		return $this->quantity;
	}

	public function getPrice(): int
	{
		return $this->product->price;
	}

	public function getCost(): int
	{
		return $this->getPrice() * $this->quantity;
	}

	public function plus(int $quantity): self
	{
		return new static($this->product, $this->quantity + $quantity);
	}

	public function changeQuantity(int $quantity): self
	{
		return new static($this->product, $quantity);
	}
}
