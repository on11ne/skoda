<?php
/* @var $this ContestItemsController */
/* @var $model ContestItems */

$this->breadcrumbs=array(
	'Конкурсные работы'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список Работ', 'url'=>array('index')),
	array('label'=>'Управление Работами', 'url'=>array('admin')),
);
?>

<h1>Создание работы</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>