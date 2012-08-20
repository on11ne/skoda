<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span>, обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teaser_text'); ?>
		<?php echo $form->textArea($model,'teaser_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'teaser_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teaser_image'); ?>
		<?php echo $form->fileField($model,'teaser_image'); ?>
		<?php echo $form->error($model,'teaser_image'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'full_text'); ?>
        <?php echo $form->textArea($model,'full_text',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'full_text'); ?>
    </div>
	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php

        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'News[created]',
            'model' => $model,
            'language'=>'ru',
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
                'changeMonth' => 'true',
                'changeYear'=>'true',
                'showButtonPanel' => 'true',
            ),
            'htmlOptions'=>array(
                'style' => 'height:20px;'
            ),
        ));
        ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php
        echo $form->radioButtonList($model, 'status', array(
            '0' => 'Нет',
            '1' => 'Да',
        ));
        ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->