<?php
$this->breadcrumbs=array(
	'Votes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список Голосов', 'url'=>array('index')),
	array('label'=>'Управление Голосов', 'url'=>array('admin')),
);
?>

<h1>Create Votes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>