<?php
/* @var $this ContestItemsController */
/* @var $model ContestItems */

$this->breadcrumbs=array(
	'Конкурсные работы'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список Работ', 'url'=>array('index')),
	array('label'=>'Создать Работу', 'url'=>array('create')),
	array('label'=>'Изменение Работ', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удаление Работ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Работами', 'url'=>array('admin')),
);
?>

<h1>Просмотр Работы #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'full_text',
		'contests',
		'user',
        'images',
        'votes_count',
		'status',
		'created',
	),
)); ?>
