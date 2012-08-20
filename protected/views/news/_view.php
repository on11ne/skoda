<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teaser_text')); ?>:</b>
	<?php echo CHtml::encode($data->teaser_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teaser_image')); ?>:</b>
	<?php echo CHtml::encode($data->teaser_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('full_text')); ?>:</b>
	<?php echo CHtml::encode($data->full_text); ?>
	<br />


</div>