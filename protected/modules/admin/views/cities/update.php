<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',   
);

$this->menu=array(
	array('label'=>'Список городов', 'url'=>array('index')),
	array('label'=>'Добавить город', 'url'=>array('create')),
	array('label'=>'Просмотр записи', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управлением списком', 'url'=>array('admin')),
);
?>

<h1>Update Cities <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>