<?php
$this->breadcrumbs=array(
	'Votes',
);

$this->menu=array(
	array('label'=>'Создать Голосов', 'url'=>array('create')),
	array('label'=>'Управление Голосов', 'url'=>array('admin')),
);
?>

<h1>Votes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
