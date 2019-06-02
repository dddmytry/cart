<?php


namespace app\store\Entities\cart\Cost\Calculator;


use app\store\Entities\cart\CartItem;
use app\store\Entities\cart\Cost\Cost;

interface CalculatorInterface
{
	/**
	 * @param CartItem[] $items
	 * @return Cost
	 */
	public function getCost(array $items): Cost;
}
