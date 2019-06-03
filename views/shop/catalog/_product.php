<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $product \app\store\Entities\Product\Product */
?>

<div class="col-sm-4 product-block" style="margin-bottom: 35px;">
	<div class="image-block">
		<a href="<?= Url::to(['/shop/catalog/product', 'slug' => $product->slug]) ?>">
			<?= Html::img($product->mainPhoto->getThumbFileUrl('file', 'full'), ['class' => 'img-responsive', 'style' => 'max-height: 200px; margin: 0 auto 10px']) ?>
		</a>

	</div>
	<div class="product-data">
		<p>
			<a href="<?= Url::to(['/shop/catalog/product', 'slug' => $product->slug]) ?>">
				<h4 class="text-center text-muted">
					<?= $product->name ?>
				</h4>
			</a>
		<h4 class="text-center"><?= $product->price ?> <small>руб.</small></h4>
		<br>
		<div class="text-center">
			<?= $product->summary ?>
		</div>
	</div>
	<div class="sale text-center">
		<a href="<?= Url::to(['/shop/cart/add-from-button', 'id' => $product->id])  ?>" class="btn btn-primary" data-method="post">В корзину  <span class="glyphicon glyphicon-shopping-cart"></span></a>
	</div>
</div>
