<?php


namespace app\store\Forms\Product;


use app\store\Entities\Product\Product;
use app\store\Validators\SlugValidator;
use yii\base\Model;

class ProductEditForm extends Model
{
	public $name;
	public $summary;
	public $body;
	public $price;
	public $slug;
	public $title;
	public $keywords;
	public $description;

	private $_product;

	public function __construct(Product $product, $config = [])
	{
		$this->name = $product->name;
		$this->summary = $product->summary;
		$this->body = $product->body;
		$this->price = $product->price;
		$this->slug = $product->slug;
		$this->title = $product->title;
		$this->keywords = $product->keywords;
		$this->description = $product->description;
		$this->_product = $product;
		parent::__construct($config);
	}

	public function rules(): array
	{
		return [
			[['name', 'price'], 'required'],
			[['name', 'slug', 'title', 'keywords'], 'string', 'max' => 255],
			[['summary', 'body', 'description'], 'string'],
			['price', 'integer'],
			['slug', SlugValidator::class],
			['slug', 'unique', 'targetClass' => Product::class, 'message' => 'Такой алиас уже существует.', 'filter' => ['<>', 'id', $this->_product->id]],
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
}
