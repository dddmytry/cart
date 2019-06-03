<?php

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\DataProviderInterface */

use yii\widgets\LinkPager; ?>

<div class="row">
	<?php
	foreach ($dataProvider->getModels() as $product) {
		echo $this->render('_product', [
			'product' => $product,
			]);
		}
	?>
</div>

<div class="row pagination-panel">
	<div class="col-sm-6 text-left">
		<?=
		LinkPager::widget([
			'pagination' => $dataProvider->getPagination()
		])
		?>
	</div>
	<div class="col-sm-6 text-right product-quantity">
		Показано <?= $dataProvider->getCount() ?> товаров из <?= $dataProvider->getTotalCount() ?>
	</div>
</div>




