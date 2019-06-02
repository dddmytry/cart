<?php

use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\store\Forms\Product\ProductCreateForm */

$this->title = 'Добавление товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?php $form = ActiveForm::begin([
	    'enableClientValidation' => false,
	    'options' => ['enctype'=>'multipart/form-data'],
    ]) ?>
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
	<div class="box box-default">
		<div class="box-header with-border">Фотографии</div>
		<div class="box-body">
			<?= $form->field($model->photos, 'files[]')->widget(FileInput::class, [
				'options' => [
					'accept' => 'image/*',
					'multiple' => true,
				],
			]) ?>
		</div>
	</div>
	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
	</div>
	<?php ActiveForm::end() ?>

</div>
