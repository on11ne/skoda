<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'votes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span>, обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'source'); ?>
		<?php echo $form->textField($model,'source',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'source'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contest_item_id'); ?>
		<?php echo $form->textField($model,'contest_item_id'); ?>
		<?php echo $form->error($model,'contest_item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_identity'); ?>
		<?php echo $form->textField($model,'user_identity',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_identity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->