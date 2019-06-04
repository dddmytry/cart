<?php


namespace app\store\Entities\Order;


use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $cost [int(11)]
 * @property string $customer_email [varchar(255)]
 * @property int $created_at [int(11)]
 *
 * @property OrderItem[] $items
 */
class Order extends ActiveRecord
{
	public static function create($customerEmail, array $items, $cost): self
	{
		$order = new static();
		$order->customer_email = $customerEmail;
		$order->items = $items;
		$order->cost = $cost;
		$order->created_at = time();

		return $order;
	}

	public function edit($customerEmail): void
	{
		$this->customer_email = $customerEmail;
	}

	##############

	public function getCost(): int
	{
		return $this->cost;
	}

	##############

	public function getItems(): ActiveQuery
	{
		return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
	}

	##############

	public function behaviors(): array
	{
		return [
			[
				'class' => SaveRelationsBehavior::class,
				'relations' => ['items'],
			],
		];
	}

	public function transactions(): array
	{
		return [
			self::SCENARIO_DEFAULT => self::OP_ALL,
		];
	}

	##############

	public static function tableName(): string
	{
		return '{{%orders}}';
	}

	public function attributeLabels(): array
	{
		return [
			'cost' => 'Сумма заказа',
			'customer_email' => 'Email заказчика',
			'created_at' => 'Отправлено',
		];
	}
}
