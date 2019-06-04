<?php


namespace app\store\Forms\Order;


use yii\base\Model;

class OrderForm extends Model
{
	public $customer_email;

	public function rules(): array
	{
		return [
			['customer_email', 'required'],
			['customer_email', 'email'],
		];
	}

	public function attributeLabels(): array
	{
		return [
			'customer_email' => 'Email заказчика',
		];
	}
}
