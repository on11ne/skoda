<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список Пользователей', 'url'=>array('index')),
	array('label'=>'Создание Пользователей', 'url'=>array('create')),
	array('label'=>'Просмотр Пользователей', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Пользователей', 'url'=>array('admin')),
);
?>

<h1>Update Users <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>