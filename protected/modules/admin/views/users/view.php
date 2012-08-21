<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список Пользователей', 'url'=>array('index')),
	array('label'=>'Создание Пользователей', 'url'=>array('create')),
	array('label'=>'Изменение Пользователей', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удаление Пользователей', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Пользователей', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'password',
		'first_name',
		'surname',
		'last_name',
		'phone',
		'company',
		'city',
		'position',
		'photo',
		'activation',
		'status',
		'registered_date',
	),
)); ?>
