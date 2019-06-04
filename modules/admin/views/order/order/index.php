<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\forms\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="box">
		<div class="box-body">
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					'id',
					'customer_email:email',
					'cost',
					'created_at:datetime',

					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{update} {delete}'
					],
				],
			]); ?>
		</div>
	</div>
</div>
