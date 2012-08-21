<?php
$this->breadcrumbs=array(
	'Votes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список Голосов', 'url'=>array('index')),
	array('label'=>'Создание Голосов', 'url'=>array('create')),
	array('label'=>'Изменение Голосов', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удаление Голосов', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Голосов', 'url'=>array('admin')),
);
?>

<h1>View Votes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'source',
		'contest_item_id',
		'user_identity',
		'created',
	),
)); ?>
