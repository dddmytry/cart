<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\store\Forms\Order\OrderEditForm */
/* @var $form \yii\bootstrap\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

	<div class="box box-default">
		<div class="box-header with-border">Данные заказчика</div>
		<div class="box-body">
			<?= $form->field($model, 'customer_email')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
