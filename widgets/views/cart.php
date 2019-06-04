<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $cart \app\store\Entities\cart\Cart */
?>

<div id="cart-widget" class="btn-group btn-block">
	<?php if ($cart->getAmount() == 0): ?>
		<button type="button" class="cart-widget">
			<span class="glyphicon glyphicon-shopping-cart"></span> Корзина пуста
		</button>
	<?php else: ?>
		<button type="button" data-toggle="dropdown" data-loading-text="Загрузка .." class="dropdown-toggle cart-widget" aria-expanded="false">
			<span class="glyphicon glyphicon-shopping-cart"></span>
			<span id="cart-total">
				<?= $cart->getAmount() ?> товар(а, ов) - <?= $cart->getCost()->getOrigin() ?> <span class="glyphicon glyphicon-rub"></span>
			</span>
		</button>
		<ul id="dropdown-cart" class="dropdown-menu pull-right" style="width: 150%;">
			<li>
				<table class="table table-striped table-hover">
					<?php foreach ($cart->getItems() as $item): ?>
						<?php $product = $item->getProduct() ?>
						<?php $url = Url::to(['/shop/catalog/product', 'slug' => $product->slug]) ?>
						<tr>
							<td class="text-center">
								<?php if ($product->main_photo): ?>
									<?= Html::img($product->mainPhoto->getThumbFileUrl('file', 'full'), ['class' => 'img-responsive', 'style' => 'max-height: 80px']) ?>
								<?php endif; ?>
							</td>
							<td class="text-left">
								<a href="<?= $url ?>">
									<?= $product->name ?>
								</a>
							</td>
							<td class="text-right">x <?= $item->getQuantity() ?></td>
							<td class="text-right"><?= $item->getCost() ?></td>
							<td class="text-center">
								<a href="<?= Url::to(['/shop/cart/remove', 'id' => $item->getId()]) ?>" title="Удалить" class="btn btn-danger btn-xs" data-method="post"><span class="glyphicon glyphicon-remove"></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</li>
			<li>
				<div>
					<?php $cost = $cart->getCost(); ?>
					<table class="table table-bordered">
						<tr>
							<td class="text-right"><strong>Итого:</strong></td>
							<td class="text-right"><?= $cost->getOrigin() ?> <span class="glyphicon glyphicon-rub"></span></td>
						</tr>
					</table>
					<p class="text-right">
						<a href="<?= Url::to(['/shop/catalog/index']) ?>">
							<strong><span class="glyphicon glyphicon-shopping-cart"></span> Продолжить покупки</strong>
						</a>

						<a href="<?= Url::to(['/shop/cart/index']) ?>">
							<strong><span class="glyphicon glyphicon-shopping-cart"></span> Перейти в корзину</strong>
						</a>

						<a href="<?= Url::to(['/shop/checkout/index']) ?>">
							<strong><span class="glyphicon glyphicon-shopping-cart"></span> Оформить заказ</strong>
						</a>
					</p>
				</div>
			</li>
		</ul>
	<?php endif; ?>
</div>
