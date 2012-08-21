<?php
$this->breadcrumbs=array(
	'Votes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список Голосов', 'url'=>array('index')),
	array('label'=>'Создание Голосов', 'url'=>array('create')),
	array('label'=>'Просмотр Голосов', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Голосов', 'url'=>array('admin')),
);
?>

<h1>Update Votes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>