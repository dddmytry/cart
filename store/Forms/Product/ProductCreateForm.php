<?php


namespace app\store\Forms\Product;


use app\store\Entities\Product\Product;
use app\store\Validators\SlugValidator;
use elisdn\compositeForm\CompositeForm;

/**
 * @property PhotosForm photos
 */
class ProductCreateForm extends CompositeForm
{
	public $name;
	public $summary;
	public $body;
	public $price;
	public $slug;
	public $title;
	public $keywords;
	public $description;

	public function __construct($config = [])
	{
		parent::__construct($config);
		$this->photos = new PhotosForm();
	}

	public function rules(): array
	{
		return [
			[['name', 'price'], 'required'],
			[['name', 'slug', 'title', 'keywords'], 'string', 'max' => 255],
			[['summary', 'body', 'description'], 'string'],
			['price', 'integer'],
			['slug', SlugValidator::class],
			['slug', 'unique', 'targetClass' => Product::class, 'message' => 'Такой алиас уже существует.'],
		];
	}

	public function attributeLabels(): array
	{
		return [
			'name' => 'Название',
			'summary' => 'Анонс',
			'body' => 'Полное описание товара',
			'price' => 'Цена',
			'slug' => 'Алиас',
			'title' => 'SEO заголовок',
			'keywords' => 'SEO ключевые слова',
			'description' => 'SEO описание',
		];
	}

	protected function internalForms(): array
	{
		return ['photos'];
	}
}
