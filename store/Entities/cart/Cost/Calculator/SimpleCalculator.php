<?php


namespace app\store\Entities\cart\Cost\Calculator;


use app\store\Entities\cart\CartItem;
use app\store\Entities\cart\Cost\Cost;

class SimpleCalculator implements CalculatorInterface
{

	/**
	 * @param CartItem[] $items
	 * @return Cost
	 */
	public function getCost(array $items): Cost
	{
		$cost = 0;
		foreach ($items as $item) {
			$cost += $item->getCost();
		}
		return new Cost($cost);
	}
}
