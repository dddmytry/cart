<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\store\Entities\Product\Product;
use app\store\Helpers\ProductHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\forms\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="box box-default">
		<div class="box-body">
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					[
						'value' => function(\app\store\Entities\Product\Product $product)
						{
							return $product->main_photo ? Html::img($product->mainPhoto->getThumbFileUrl('file', 'full'), ['class' => 'img-responsive', 'style' => 'max-height: 100px']) : null;
						},
						'format' => 'raw',
					],
					'id',
					[
						'attribute' => 'name',
						'value' => function(Product $product)
						{
							return Html::a(Html::encode($product->name), ['view', 'id' => $product->id]);
						},
						'format' => 'raw',
					],
					'price',
					[
						'attribute' => 'status',
						'filter' => ProductHelper::statusList(),
						'value' => function(Product $product)
						{
							return ProductHelper::statusLabel($product->status);
						},
						'format' => 'raw',
					],

					['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
		</div>
	</div>
</div>
