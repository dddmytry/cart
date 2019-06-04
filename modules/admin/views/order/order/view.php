<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order app\store\Entities\Order\Order */

$this->title = $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $order->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

	<div class="box box-default">
		<div class="box-header with-border">Данные пользователя и заказа</div>
		<div class="box-body">
			<?= DetailView::widget([
				'model' => $order,
				'attributes' => [
					'id',
					'customer_email:email',
					[
						'attribute' => 'cost',
						'value' => $order->cost . ' <span class="glyphicon glyphicon-rub"></span>',
						'format' => 'raw',
					],
					'created_at:datetime',
				],
			]) ?>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-header with-border">Заказано</div>
		<div class="box-body">

				<table class="table table-bordered table-hover">
					<thead>
					<tr>
						<th>ID товара</th>
						<th>Назнание товара</th>
						<th>Цена</th>
						<th>Кол-во</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($order->items as $item): ?>
						<tr>
							<td><?= $item->product_id ?></td>
							<td><?= $item->product_name ?></td>
							<td><?= $item->price ?> <span class="glyphicon glyphicon-rub"></span></td>
							<td><?= $item->quantity ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

		</div>
	</div>



</div>
