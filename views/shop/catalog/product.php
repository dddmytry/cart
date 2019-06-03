<?php

/* @var $this \yii\web\View */
/* @var $product \app\store\Entities\Product\Product */

$this->title = $product->title ?: $product->name;

$this->registerMetaTag(['name' => 'description', 'content' => $product->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $product->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\helpers\Url; ?>

<div class="catalog-product">
	<div class="row">
		<div class="col-sm-3">
			<div class="image-block">
				<?= Html::img($product->mainPhoto->getThumbFileUrl('file', 'full'), ['class' => 'img-responsive', 'style' => 'margin: 0 auto 10px']) ?>
			</div>
			<h4 class="text-center"><?= $product->price ?> <small>руб.</small></h4>
			<div class="sale text-center">
				<a href="<?= Url::to(['/shop/cart/add-from-button', 'id' => $product->id])  ?>" class="btn btn-primary" data-method="post">В корзину  <span class="glyphicon glyphicon-shopping-cart"></span></a>
			</div>
		</div>
		<div class="col-sm-7">
			<?= $product->body ?>
		</div>
	</div>
</div>
