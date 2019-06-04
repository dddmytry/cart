<?php

namespace app\controllers\shop;

use app\store\Entities\cart\Cart;
use app\store\Forms\Order\OrderForm;
use app\store\Services\Order\OrderService;
use yii\web\Controller;

class CheckoutController extends Controller
{
	private $cart;
	private $service;

	public function __construct(
		$id,
		$module,
		Cart $cart,
		OrderService $service,
		$config = []
	)
	{
		parent::__construct($id, $module, $config);
		$this->cart = $cart;
		$this->service = $service;
	}

	public function actionIndex()
	{
		$form = new OrderForm();
		if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
			try{
				$this->service->checkout($form);
				\Yii::$app->session->setFlash('success', 'Ваш заказ отправлен.');
				return $this->redirect(\Yii::$app->getHomeUrl());
			} catch (\DomainException $e) {
				\Yii::$app->errorHandler->logException($e);
				\Yii::$app->session->setFlash('error', $e->getMessage());
			}
		}
		return $this->render('index', [
			'cart' => $this->cart,
			'model' => $form,
		]);
	}
}
