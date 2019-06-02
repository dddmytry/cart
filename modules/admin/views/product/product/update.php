<?php

use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\store\Forms\Product\ProductEditForm */
/* @var $product \app\store\Entities\Product\Product */

$this->title = 'Редактирование товара: ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="product-update">

    <?php $form = ActiveForm::begin() ?>
	<div class="box box-default">
		<div class="box-header with-border">Данные товара</div>
		<div class="box-body">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'summary')->widget(CKEditor::class) ?>
			<?= $form->field($model, 'body')->widget(CKEditor::class) ?>
			<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'slug')->textInput(['maxlength' => true])->hint('Заполнять не обязательно.') ?>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-header with-border">SEO</div>
		<div class="box-body">
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
		</div>
	</div>
	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
	</div>
	<?php ActiveForm::end() ?>

</div>
