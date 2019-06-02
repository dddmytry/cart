<?php


namespace app\store\Entities\Product;


use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property int $main_photo [int(11)]
 * @property string $summary
 * @property string $body
 * @property int $price [int(11)]
 * @property string $slug [varchar(255)]
 * @property string $status [varchar(16)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $title [varchar(255)]
 * @property string $keywords [varchar(255)]
 * @property string $description
 *
 * @property Photo[] $photos
 * @property Photo $mainPhoto
 */
class Product extends ActiveRecord
{
	public const STATUS_DRAFT = 'draft';
	public const STATUS_ACTIVE = 'active';

	public static function create($name, $summary, $body, $price, $slug, $title, $keywords, $description): self
	{
		$product = new static();
		$product->name = $name;
		$product->summary = $summary;
		$product->body = $body;
		$product->price = $price;
		$product->slug = $slug;
		$product->status = self::STATUS_DRAFT;
		$product->title = $title;
		$product->keywords = $keywords;
		$product->description = $description;
		$product->created_at = time();

		return $product;
	}

	public function edit($name, $summary, $body, $price, $slug, $title, $keywords, $description): void
	{
		$this->name = $name;
		$this->summary = $summary;
		$this->body = $body;
		$this->price = $price;
		$this->slug = $slug;
		$this->title = $title;
		$this->keywords = $keywords;
		$this->description = $description;
		$this->updated_at = time();
	}

	#################

	public function isActive(): bool
	{
		return $this->status === self::STATUS_ACTIVE;
	}

	public function activate(): void
	{
		if ($this->isActive()) {
			throw new \DomainException('Товар уже активен.');
		}
		$this->status = self::STATUS_ACTIVE;
	}

	public function isDraft(): bool
	{
		return $this->status === self::STATUS_DRAFT;
	}

	public function draft(): void
	{
		if ($this->isDraft()) {
			throw new \DomainException('Товар уже снят с продаж.');
		}
		$this->status = self::STATUS_DRAFT;
	}

	#################

	public function addPhoto(UploadedFile $file): void
	{
		$photos = $this->photos;
		$photos[] = Photo::create($file);
		$this->updatePhotos($photos);
	}

	public function removePhoto($id): void
	{
		$photos = $this->photos;
		foreach ($photos as $i => $photo) {
			if ($photo->isEqualTo($id)) {
				unset($photos[$i]);
				$this->updatePhotos($photos);
				return;
			}
		}
		throw new \DomainException('Фото не найдено.');
	}

	public function movePhotoUp($id): void
	{
		$photos = $this->photos;
		foreach ($photos as $i => $photo) {
			if ($photo->isEqualTo($id)) {
				if ($prev = $photos[$i - 1] ?? null) {
					$photos[$i - 1] = $photo;
					$photos[$i] = $prev;
					$this->updatePhotos($photos);
				}
				return;
			}
		}
		throw new \DomainException('Фото не найдено.');
	}

	public function movePhotoDown($id): void
	{
		$photos = $this->photos;
		foreach ($photos as $i => $photo) {
			if ($photo->isEqualTo($id)) {
				if ($next = $photos[$i + 1] ?? null) {
					$photos[$i + 1] = $photo;
					$photos[$i] = $next;
					$this->updatePhotos($photos);
				}
				return;
			}
		}
		throw new \DomainException('Фото не найдено.');
	}

	private function updatePhotos(array $photos): void
	{
		foreach ($photos as $i => $photo) {
			/** @var Photo $photo */
			$photo->setSort($i);
		}
		$this->photos = $photos;
	}

	#################

	public function getPhotos(): ActiveQuery
	{
		return $this->hasMany(Photo::class, ['product_id' => 'id'])->orderBy('sort');
	}

	public function getMainPhoto(): ActiveQuery
	{
		return $this->hasOne(Photo::class, ['id' => 'main_photo']);
	}

	#################

	public function behaviors(): array
	{
		return [
			[
				'class' => SaveRelationsBehavior::class,
				'relations' => [
					'photos',
				],
			],
		];
	}

	public function transactions(): array
	{
		return [
			self::SCENARIO_DEFAULT => self::OP_ALL,
		];
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
		if (!empty($this->photos)) {
			$this->updateAttributes(['main_photo' => $this->photos[0]->id]);
		}
	}

	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			foreach ($this->photos as $photo) {
				$photo->delete();
			}
		}
		return false;
	}

	#################

	public static function tableName(): string
	{
		return '{{%products}}';
	}

	public function attributeLabels(): array
	{
		return [
			'name' => 'Название',
			'main_photo' => 'Главное фото',
			'summary' => 'Анонс',
			'body' => 'Полное описание товара',
			'price' => 'Цена',
			'slug' => 'Алиас',
			'status' => 'Статус',
			'created_at' => 'Создано',
			'updated_at' => 'Отредактировано',
			'title' => 'SEO заголовок',
			'keywords' => 'SEO ключевые слова',
			'description' => 'SEO описание',
		];
	}
}
