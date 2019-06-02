<?php


namespace app\store\Entities\cart\Storage;


use app\store\Entities\cart\CartItem;

interface StorageInterface
{
	/**
	 * @return CartItem[]
	 */
	public function load(): array ;
	/**
	 * @param CartItem[] $items
	 */
	public function save(array $items): void ;
}
