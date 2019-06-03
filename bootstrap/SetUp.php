<?php


namespace app\bootstrap;


use app\store\Entities\cart\Cart;
use app\store\Entities\cart\Cost\Calculator\SimpleCalculator;
use app\store\Entities\cart\Storage\CookieStorage;
use yii\base\Application;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$container = \Yii::$container;

		$container->setSingleton(Cart::class, function () use ($app) {
			return new Cart(
				new CookieStorage('cart', 60*60*12),
				new SimpleCalculator()
			);
		});
	}
}
