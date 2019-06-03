<?php


namespace app\controllers\shop;


use app\store\FrontModels\ProductReadModel;
use app\store\Services\Cart\CartService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CartController extends Controller
{
	private $products;
	private $service;

	public function __construct(
		$id,
		$module,
		ProductReadModel $products,
		CartService $service,
		$config = []
	)
	{
		parent::__construct($id, $module, $config);
		$this->products = $products;
		$this->service = $service;
	}

	public function behaviors(): array
	{
		return [
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					'quantity' => ['POST'],
					'remove' => ['POST'],
					'clear' => ['POST'],
					'add-from-button' => ['POST'],
				],
			],
		];
	}

	public function actionIndex()
	{
		$cart = $this->service->getCart();

		return $this->render('index', [
			'cart' => $cart,
		]);
	}

	public function actionAddFromButton($id)
	{
		if (!$product = $this->products->findById($id)) {
			throw new NotFoundHttpException('Товар не найден.');
		}

		try{
			$this->service->add($product->id, 1);
			\Yii::$app->session->setFlash('success', 'Товар добавлен в корзину.');
			return $this->redirect(\Yii::$app->request->referrer);
		} catch (\DomainException $e) {
			\Yii::$app->errorHandler->logException($e);
			\Yii::$app->session->setFlash('error', $e->getMessage());
		}
		return $this->redirect(\Yii::$app->request->referrer);
	}

	public function actionQuantity($id)
	{
		try{
			$this->service->set($id, \Yii::$app->request->post('quantity'));
		} catch (\DomainException $e) {
			\Yii::$app->errorHandler->logException($e);
			\Yii::$app->session->setFlash('error', $e->getMessage());
		}
		return $this->redirect(['index']);
	}

	public function actionRemove($id)
	{
		try{
			$this->service->remove($id);
		} catch (\DomainException $e) {
			\Yii::$app->errorHandler->logException($e);
			\Yii::$app->session->setFlash('error', $e->getMessage());
		}
		return $this->redirect(['index']);
	}

	public function actionClear()
	{
		try{
			$this->service->clear();
		} catch (\DomainException $e) {
			\Yii::$app->errorHandler->logException($e);
			\Yii::$app->session->setFlash('error', $e->getMessage());
		}
		return $this->redirect(['index']);
	}
}
