<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $cart \app\store\Entities\cart\Cart */
/* @var $model \app\store\Forms\Order\OrderForm */

$this->title = 'Оформление заказа';

$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина покупок', 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-index">
	<h1 class="text-center"><?= Html::encode($this->title) ?></h1>

	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
			<tr>
				<th class="text-left">Название товара</th>
				<th class="text-left">Кол-во</th>
				<th class="text-right">Цена</th>
				<th class="text-right">Всего</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach ($cart->getItems() as $item): ?>
					<?php $product = $item->getProduct() ?>
					<?php $url = Url::to(['/shop/catalog/product', 'slug' => $product->slug]) ?>
					<tr>
						<td class="text-left"><?= $product->name ?></td>
						<td class="text-left"><?= $item->getQuantity() ?></td>
						<td class="text-right"><?= $item->getPrice() ?> <span class="glyphicon glyphicon-rub"></span></td>
						<td class="text-right"><?= $item->getCost() ?> <span class="glyphicon glyphicon-rub"></span></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<br>
	<?php $cost = $cart->getCost() ?>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<tr>
				<td><strong>Итого:</strong></td>
				<td class="text-right"><?= $cost->getOrigin() ?> <span class="glyphicon glyphicon-rub"></span></td>
			</tr>
		</table>
	</div>
	<?php $form = ActiveForm::begin() ?>
	<div class="panel panel-default">
		<div class="panel-heading">Ваши данные</div>
		<div class="panel-body">
			<?= $form->field($model, 'customer_email')->textInput(['maxlength' => true, 'placeholder' => 'Электронная почта']) ?>
		</div>
	</div>
	<div class="form-group">
		<?= Html::submitButton('Заказать', ['class' => 'btn btn-primary']) ?>
	</div>
	<?php ActiveForm::end() ?>
</div>


