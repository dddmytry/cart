<?php


namespace app\store\Helpers;


use app\store\Entities\Product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ProductHelper
{
	public static function statusList(): array
	{
		return [
			Product::STATUS_DRAFT => 'Отключен',
			Product::STATUS_ACTIVE => 'Активен',
		];
	}

	public static function statusLabel($status): string
	{
		switch ($status) {
			case 'draft' :
				$class = 'label label-danger'; break;
			case 'active' :
				$class = 'label label-success'; break;
			default :
				$class = 'label label-default';
		}
		return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), ['class' => $class]);
	}
}
