<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список Пользователей', 'url'=>array('index')),
	array('label'=>'Создание Пользователей', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Пользователями</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=> $model->search(),
	'filter'=> $model,
	'columns'=>array(
		'email',
		'first_name',
		'surname',
		'last_name',
		'phone',
        array(
            'name' => 'city',
            'value'=> '$data->city_object->title',
        ),
        array(
            'name' => 'company',
            'value'=> '$data->company_object->title',
        ),
		'position',
        array(
            'name' => 'status',
            'value'=> '
            ($data->status == 2) ? "Подтверждён" : (
                ($data->status == 1) ? "Активирован" : (
                    ($data->status == 0) ? "Не подтверждён" : "Нет статуса"
                )
            )',
        ),
		'registered_date',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
