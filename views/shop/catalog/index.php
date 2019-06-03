<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\DataProviderInterface */

$this->title = 'Каталог товаров';

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h1 class="text-center"><?= Html::encode($this->title) ?></h1>
		<div class="select-panel">
			<div class="row">
				<div class="col-md-2 col-sm-4 hidden-xs">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-default  active" id="grid-view" data-toggle="tooltip" title="Просмотр в виде сетки"><span class="glyphicon glyphicon-th"></span></button>
						<button type="button" class="btn btn-default" id="list-view" data-toggle="tooltip" title="Просмотр списком"><span class="glyphicon glyphicon-th-list"></span></button>
					</div>
				</div>
			</div>
	</div>
	<div class="panel-body">
		<?= $this->render('_list', [
			'dataProvider' => $dataProvider,
		]) ?>
	</div>
</div>


</div>
