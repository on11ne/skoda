<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список Пользователей', 'url'=>array('index')),
	array('label'=>'Управление Пользователей', 'url'=>array('admin')),
);
?>

<h1>Create Users</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>