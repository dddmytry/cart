<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $cart \app\store\Entities\cart\Cart */

$this->title = 'Корзина товаров';

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cart-index">
	<?php if (count($cart->getItems()) > 0): ?>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
				<tr>
					<th class="text-center" style="width: 100px"></th>
					<th class="text-left">название</th>
					<th class="text-left">Количество</th>
					<th class="text-right">Цена за ед-цу</th>
					<th class="text-right">Всего</th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($cart->getItems() as $item): ?>
						<?php $product = $item->getProduct() ?>
						<?php $url = Url::to(['/shop/catalog/product', 'slug' => $product->slug]) ?>
						<tr>
							<td>
								<a href="<?= $url ?>">
									<?php if ($product->main_photo): ?>
										<?= Html::img($product->mainPhoto->getThumbFileUrl('file', 'full'), ['class' => 'img-responsive']) ?>
									<?php endif; ?>
								</a>
							</td>
							<td class="text-left">
								<a href="<?= $url ?>" class="text-muted">
									<?= $product->name ?>
								</a>
							</td>
							<td class="text-left">
								<?= Html::beginForm(['quantity', 'id' => $item->getId()]) ?>
								<div class="row">
									<div class="col-sm-6">
										<label for="quantity" class="sr-only">Количество</label>
										<input id="quantity" type="text" name="quantity" value="<?= $item->getQuantity() ?>" size="1" class="form-control" />
									</div>
									<div class="col-sm-6">
										<span class="input-group-btn">
                                    <button type="submit" title="" class="btn btn-primary" data-original-title="Обновить"><span class="glyphicon glyphicon-refresh"></span></button>
                                    <a title="Удалить" class="btn btn-danger" href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>" data-method="post"><span class="glyphicon glyphicon-remove"></span></a>
                                </span>
									</div>
								</div>
								<?= Html::endForm() ?>
							</td>
							<td class="text-right">
								<?= $item->getPrice() ?> руб.
							</td>
							<td class="text-right">
								<?= $item->getCost() ?> руб.
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div><br>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-8">
				<?php $cost = $cart->getCost() ?>
				<table class="table table-bordered table-hover">
					<tr>
						<td>Итого:</td>
						<td><?= $cost->getOrigin() ?> руб.</td>
					</tr>
				</table>
			</div>
		</div>
		<p class="text-right">
			<a href="<?= Url::to(['/shop/cart/clear']) ?>" class="text-danger" data-method="post">
				<strong><span class="glyphicon glyphicon-trash"></span> Очистить корзину</strong>
			</a>

			<a href="<?= Url::to(['/shop/catalog/index']) ?>" class="text-danger">
				<strong><span class="glyphicon glyphicon-shopping-cart"></span> Продолжить покупки</strong>
			</a>

			<a href="<?= Url::to(['/shop/checkout/index']) ?>"  class="text-danger">
				<strong><span class="glyphicon glyphicon-pencil"></span> Оформить заказ</strong>
			</a>
		</p>
	<?php else: ?>
		<div class="jumbotron">
			<h1 class="text-center">
				Корзина пуста
			</h1>
		</div>
	<?php endif; ?>
</div>
