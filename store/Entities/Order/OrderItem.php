<?php


namespace app\store\Entities\Order;


use app\store\Entities\Product\Product;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $order_id [int(11)]
 * @property int product_id
 * @property string $product_name [varchar(255)]
 * @property int $price [int(11)]
 * @property int $quantity [int(11)]
 */
class OrderItem extends ActiveRecord
{
	public static function create(Product $product, $price, $quantity): self
	{
		$item = new static();
		$item->product_id = $product->id;
		$item->product_name = $product->name;
		$item->price = $price;
		$item->quantity = $quantity;

		return $item;
	}

	public function getCost(): int
	{
		return $this->price * $this->quantity;
	}

	public static function tableName(): string
	{
		return '{{%order_items}}';
	}

	public function attributeLabels(): array
	{
		return [
			'order_id' => 'Номер заказа',
			'product_id' => 'ID товара',
			'product_name' => 'Название товара',
			'price' => 'Цена товара',
			'quantity' => 'Количество',
		];
	}
}
