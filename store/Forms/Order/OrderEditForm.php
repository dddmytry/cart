<?php


namespace app\store\Forms\Order;


use app\store\Entities\Order\Order;
use yii\base\Model;

class OrderEditForm extends Model
{
	public $customer_email;
	/**
	 * @var Order
	 */
	private $order;

	public function __construct(Order $order, $config = [])
	{
		parent::__construct($config);
		$this->order = $order;
	}

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
