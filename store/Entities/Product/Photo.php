<?php


namespace app\store\Entities\Product;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;


/**
 * @property UploadedFile file
 * @property int $id [int(11)]
 * @property int $product_id [int(11)]
 * @property int $sort [int(11)]
 *
 * @mixin ImageUploadBehavior
 */
class Photo extends ActiveRecord
{
	public static function create(UploadedFile $file): self
	{
		$photo = new static();
		$photo->file = $file;

		return $photo;
	}

	public function setSort($sort)
	{
		$this->sort = $sort;
	}

	public function isEqualTo($id): bool
	{
		return $this->id == $id;
	}

	public function attributeLabels(): array
	{
		return [
			'file' => 'Фото',
		];
	}

	public static function tableName(): string
	{
		return '{{%product_photos}}';
	}

	public function behaviors(): array
	{
		return [
			[
				'class' => ImageUploadBehavior::class,
				'createThumbsOnRequest' => true,
				'attribute' => 'file',
				'filePath' => '@webroot/files/products/origin/[[attribute_product_id]]/[[id]].[[extension]]',
				'fileUrl' => '@web/files/products/origin/[[attribute_product_id]]/[[id]].[[extension]]',
				'thumbPath' => '@webroot/files/products/cache/[[attribute_product_id]]/[[profile]]/[[id]].[[extension]]',
				'thumbUrl' => '@web/files/products/cache/[[attribute_product_id]]/[[profile]]/[[id]].[[extension]]',
				'thumbs' => [
					'full' => ['width' => 800, 'height' => 800],
				],
			],
		];
	}
}
