<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список городов', 'url'=>array('index')),
	array('label'=>'Управлением списком', 'url'=>array('admin')),
);
?>

<h1>Добавить город</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>