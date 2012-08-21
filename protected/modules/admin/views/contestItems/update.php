<?php
/* @var $this ContestItemsController */
/* @var $model ContestItems */

$this->breadcrumbs=array(
	'Contest Items'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список Работ', 'url'=>array('index')),
	array('label'=>'Создать Работу', 'url'=>array('create')),
	array('label'=>'Просмотр Работы', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Работами', 'url'=>array('admin')),
);
?>

<h1>Изменение Работы #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>