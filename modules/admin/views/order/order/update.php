<?php

/* @var $this yii\web\View */
/* @var $model \app\store\Forms\Order\OrderEditForm */
/* @var $order \app\store\Entities\Order\Order */

$this->title = 'Редактирование заказа: ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $order->id, 'url' => ['view', 'id' => $order->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="order-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
