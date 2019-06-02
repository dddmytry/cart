<?php


namespace app\store\Entities\cart\Cost;


class Cost
{
	private $value;

	public function __construct(float $value)
	{
		$this->value = $value;
	}

	public function getOrigin(): float
	{
		return $this->value;
	}
}
