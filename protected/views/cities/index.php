<?php
/* @var $this CitiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cities',
);

$this->menu=array(
	array('label'=>'Добавить город', 'url'=>array('create')),
	array('label'=>'Управлением списком', 'url'=>array('admin')),
);
?>

<h1>Cities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
