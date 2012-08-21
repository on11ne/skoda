<?php
/* @var $this ContestItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Конкурсные работы',
);

$this->menu=array(
	array('label'=>'Создать Работу', 'url'=>array('create')),
	array('label'=>'Управление Работами', 'url'=>array('admin')),
);
?>

<h1>Конкурсные работы</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)); ?>
