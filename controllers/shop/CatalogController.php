<?php


namespace app\controllers\shop;


use app\store\FrontModels\ProductReadModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
	private $products;

	public function __construct(
		$id,
		$module,
		ProductReadModel $products,
		$config = []
	)
	{
		parent::__construct($id, $module, $config);
		$this->products = $products;
	}

	public function actionIndex()
	{
		$dataProvider = $this->products->getAll();

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionProduct($slug)
	{
		if (!$product = $this->products->findBySlug($slug)) {
			throw new NotFoundHttpException('Страница не найдена.');
		}
		return $this->render('product', [
			'product' => $product,
		]);
	}
}
