<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form-register-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name'); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname'); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name'); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
        <?php $this->widget('CAutoComplete',
        array(
            //name of the html field that will be generated
            'name' => 'company_title',
            //replace controller/action with real ids
            'url'=> array('companies/autoCompleteLookup'),
            'max' => 10, //specifies the max number of items to display

            //specifies the number of chars that must be entered
            //before autocomplete initiates a lookup
            'minChars' => 2,
            'delay' => 500, //number of milliseconds before lookup occurs
            'matchCase' => false, //match case when performing a lookup?

            //any additional html attributes that go inside of
            //the input field can be defined here
            'htmlOptions'=>array('size'=>'40'),

            'methodChain'=>".result(function(event,item){\$(\"#company\").val(item[1]);})",
        ));
        ?>
        <?php echo CHtml::hiddenField('company'); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model,'city'); ?>
        <?php $this->widget('CAutoComplete',
        array(
            //name of the html field that will be generated
            'name' => 'city_title',
            //replace controller/action with real ids
            'url'=> array('cities/autoCompleteLookup'),
            'max' => 10, //specifies the max number of items to display

            //specifies the number of chars that must be entered
            //before autocomplete initiates a lookup
            'minChars' => 2,
            'delay' => 500, //number of milliseconds before lookup occurs
            'matchCase' => false, //match case when performing a lookup?

            //any additional html attributes that go inside of
            //the input field can be defined here
            'htmlOptions'=>array('size'=>'40'),

            'methodChain'=>".result(function(event,item){\$(\"#city\").val(item[1]);})",
        ));
        ?>
        <?php echo CHtml::hiddenField('city'); ?>
        <?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->textField($model,'photo'); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->