<?php
$this->breadcrumbs=array(
	'Новости'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список новостей', 'url'=>array('index')),
	array('label'=>'Управление списком', 'url'=>array('admin')),
);
?>

<h1>Создать материал</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>