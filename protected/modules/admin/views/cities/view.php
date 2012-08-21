<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список городов', 'url'=>array('index')),
	array('label'=>'Создать запись', 'url'=>array('create')),
	array('label'=>'Изменить запись', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалисть записи', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление списком', 'url'=>array('admin')),
);
?>

<h1>Просмотр записи #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>
