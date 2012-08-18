<?php
/* @var $this ContestItemsController */
/* @var $model ContestItems */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contest-items-add-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

    <p class="note"><?php echo Yii::app()->user->name; ?></p>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'images'); ?>
		<?php echo $form->error($model,'images');

        $this->widget('CMultiFileUpload', array(
            'model'=>$model,
            'attribute'=>'images',
            'accept'=>'jpg|gif',
            'options'=>array(
                'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
                'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
                'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
            ),
        ));
        ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'full_text'); ?>
		<?php echo $form->textArea($model,'full_text'); ?>
		<?php echo $form->error($model,'full_text'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->