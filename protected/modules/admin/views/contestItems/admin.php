<?php
/* @var $this ContestItemsController */
/* @var $model ContestItems */

$this->breadcrumbs=array(
	'Конкурсные работы'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список Работ', 'url'=>array('index')),
	array('label'=>'Создание Работы', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contest-items-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление списком работ</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'contest-items-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns'=>array(
		'id',
		'title',
		'full_text',
        array(
            'name' => 'contests',
            'value'=> '$data->contests->title',
        ),
        array(
            'name' => 'user',
            'value'=> '$data->user->surname . " " . $data->user->first_name',
        ),
        array(
            'name' => 'status',
            'value'=> '
            ($data->status == 1) ? "Подтвержден" : (
                ($data->status == 0) ? "Не подтверждён" : "Нет статуса"
            )',
        ),
		/*
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
