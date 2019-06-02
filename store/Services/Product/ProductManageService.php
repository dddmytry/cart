<?php


namespace app\store\Services\Product;


use app\store\Entities\Product\Product;
use app\store\Forms\Product\PhotosForm;
use app\store\Forms\Product\ProductCreateForm;
use app\store\Forms\Product\ProductEditForm;
use app\store\Repositories\ProductRepository;
use yii\helpers\Inflector;

class ProductManageService
{
	private $products;

	public function __construct(ProductRepository $products)
	{
		$this->products = $products;
	}

	public function create(ProductCreateForm $form): Product
	{
		$product = Product::create(
			$form->name,
			$form->summary,
			$form->body,
			$form->price,
			$form->slug ?: Inflector::slug($form->name),
			$form->title,
			$form->keywords,
			$form->description
		);

		if (!empty($form->photos->files)) {
			foreach ($form->photos->files as $file) {
				$product->addPhoto($file);
			}
		}

		$this->products->save($product);
		return $product;
	}

	public function edit($id, ProductEditForm $form): void
	{
		$product = $this->products->get($id);
		$product->edit(
			$form->name,
			$form->summary,
			$form->body,
			$form->price,
			$form->slug ?: Inflector::slug($form->name),
			$form->title,
			$form->keywords,
			$form->description
		);
		$this->products->save($product);
	}

	public function draft($id): void
	{
		$product = $this->products->get($id);
		$product->draft();
		$this->products->save($product);
	}

	public function activate($id): void
	{
		$product = $this->products->get($id);
		$product->activate();
		$this->products->save($product);
	}

	public function addPhotos($id, PhotosForm $form): void
	{
		$product = $this->products->get($id);
		foreach ($form->files as $photo) {
			$product->addPhoto($photo);
		}
		$this->products->save($product);
	}

	public function movePhotoUp($id, $photoId): void
	{
		$product = $this->products->get($id);
		$product->movePhotoUp($photoId);
		$this->products->save($product);
	}

	public function movePhotoDown($id, $photoId): void
	{
		$product = $this->products->get($id);
		$product->movePhotoDown($photoId);
		$this->products->save($product);
	}

	public function removePhoto($id, $photoId): void
	{
		$product = $this->products->get($id);
		$product->removePhoto($photoId);
		$this->products->save($product);
	}

	public function remove($id): void
	{
		$product = $this->products->get($id);
		$this->products->remove($product);
	}


}
