<?php


namespace app\bootstrap;


use yii\base\Application;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$container = \Yii::$container;
	}
}
