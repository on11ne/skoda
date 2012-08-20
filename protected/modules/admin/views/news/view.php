<?php
$this->breadcrumbs=array(
	'Новости'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список новостей', 'url'=>array('index')),
	array('label'=>'Создать материал', 'url'=>array('create')),
	array('label'=>'Изменить новость', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить новость', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление списком', 'url'=>array('admin')),
);
?>

<h1>Просмотр новости #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'visible' => false,
            'name' => 'id'
        ),
		'title',
        'full_text:html',
		'teaser_text',
        array(
            'label' => 'Изображение',
            'type' => 'image',
            'name' => 'teaser_image'
        ),
        array(
            'label' => 'Дата создания',
            'type' => 'text',
            'name' => 'created'
        ),
        array(
            'label' => 'Публикация',
            'type' => 'boolean',
            'name' => 'status'
        ),
	),
)); ?>
