<?php

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\store\Helpers\ProductHelper;

/* @var $this yii\web\View */
/* @var $product app\store\Entities\Product\Product */
/* @var $photosForm \app\store\Forms\Product\PhotosForm */

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $product->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
	    <?php if ($product->isDraft()): ?>
	        <?= Html::a('Активировать', ['activate', 'id' => $product->id], ['class' => 'btn btn-info', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Отключить', ['draft', 'id' => $product->id], ['class' => 'btn btn-warning', 'data-method' => 'post']) ?>
	    <?php endif; ?>
    </p>

	<div class="box box-default">
		<div class="box-header with-border">Свойства товара</div>
		<div class="box-body">
			<?= DetailView::widget([
				'model' => $product,
				'attributes' => [
					'id',
					'name',
					[
						'attribute' => 'main_photo',
						'value' => $product->main_photo ? Html::img($product->mainPhoto->getThumbFileUrl('file', 'full'), ['class' => 'img-responsive', 'style' => 'max-height: 150px;']) : null,
						'format' => 'raw',
					],
					'summary:html',
					'body:html',
					'price',
					'slug',
					[
						'attribute' => 'status',
						'value' => ProductHelper::statusLabel($product->status),
						'format' => 'raw',
					],
					'created_at:datetime',
					'updated_at:datetime',
				],
			]) ?>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-header with-border">SEO</div>
		<div class="box-body">
			<?= DetailView::widget([
				'model' => $product,
				'attributes' => [
					'title',
					'keywords',
					'description:ntext',
				],
			]) ?>
		</div>
	</div>
	<div class="box box-default" id="photos">
		<div class="box-header with-border">Фотографии</div>
		<div class="box-body">
			<div class="row">
				<?php foreach ($product->photos as $photo): ?>
					<div class="col-sm-3" style="text-align: center">
						<div class="btn-group">
							<?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['move-photo-up', 'id' => $product->id, 'photoId' => $photo->id], [
								'class' => 'btn btn-default',
								'data-method' => 'post',
							]); ?>
							<?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['remove-photo', 'id' => $product->id, 'photoId' => $photo->id], [
								'class' => 'btn btn-default',
								'data-method' => 'post',
								'data-confirm' => 'Удалить фото?',
							]); ?>
							<?= Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['move-photo-down', 'id' => $product->id, 'photoId' => $photo->id], [
								'class' => 'btn btn-default',
								'data-method' => 'post',
							]); ?>
						</div>
						<div>
							<?= Html::img($photo->getThumbFileUrl('file', 'full'), ['class' => 'img-responsive', 'style' => 'max-height: 200px'])?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<br><br>
			<?php $form = ActiveForm::begin([
				'options' => ['enctype'=>'multipart/form-data'],
			]); ?>

			<?= $form->field($photosForm, 'files[]')->label(false)->widget(FileInput::class, [
				'options' => [
					'accept' => 'image/*',
					'multiple' => true,
				]
			]) ?>

			<div class="form-group">
				<?= Html::submitButton('Закачать', ['class' => 'btn btn-success']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
